<?php

declare(strict_types=1);

namespace telegramBotApiPhp\WebApp;

/**
 * Telegram Mini App (Web App) `initData` validator.
 *
 * A Mini App frontend receives a signed identity string from Telegram via
 * `window.Telegram.WebApp.initData` (also present in `initDataUnsafe`,
 * which must NEVER be trusted — it is unsigned). Before your backend serves
 * any data to the Mini App, it must verify that string against YOUR bot
 * token using Telegram's official HMAC-SHA256 scheme:
 *
 *   1. Parse `initData` as a query string; take `hash` out.
 *   2. Build the data-check-string: every remaining field as `key=value`,
 *      sorted alphabetically by key, joined with "\n" (0x0A).
 *   3. secret_key   = HMAC_SHA256(key="WebAppData", message=BOT_TOKEN)
 *   4. computed     = HMAC_SHA256(key=secret_key, message=data_check_string) — hex
 *   5. Valid iff computed === hash (constant-time compare).
 *
 * Example — an API endpoint of your Mini App:
 *
 *   use telegramBotApiPhp\WebApp\InitData;
 *
 *   $res = InitData::validate($_POST['initData'] ?? '', BOT_TOKEN);
 *   if (!$res['ok']) {
 *       http_response_code(401);
 *       echo json_encode(['ok' => false, 'error' => $res['error']]);
 *       exit;
 *   }
 *   $me    = $res['user'];        // ['id' => 555000111, 'first_name' => 'Ali', ...]
 *   $promo = $res['start_param']; // deep-link payload from ?startapp=...
 *
 * Security notes:
 *  - Validate on EVERY privileged request, not only on first load.
 *  - Keep `max_age` short (e.g. 3600) for sensitive operations; the default
 *    is 86400 seconds. Pass `['max_age' => 0]` to disable the check entirely.
 *  - The comparison is constant-time (`hash_equals`); never use `===` on the hash.
 *  - Telegram also sends a `signature` field (Ed25519) used for validating
 *    third-party Mini Apps. When validating YOUR OWN bot's Mini App, the
 *    HMAC `hash` check above is the official and sufficient scheme.
 *
 * @package telegramBotApiPhp\WebApp
 */
final class InitData
{
    /** Default maximum age of auth_date, in seconds (24 hours). */
    public const DEFAULT_MAX_AGE = 86400;

    /**
     * Validate a raw `initData` string against a bot token.
     *
     * @param string $initData Raw initData query string (Telegram.WebApp.initData)
     * @param string $botToken The bot token the Mini App belongs to
     * @param array{max_age?:int} $options `max_age`: max allowed age of auth_date
     *                                     in seconds (default 86400, 0 = no check)
     *
     * @return array Success:
     *               ['ok' => true, 'user' => ?array, 'auth_date' => int,
     *                'start_param' => ?string, 'fields' => array<string,string>,
     *                'hash' => string]
     *               Failure:
     *               ['ok' => false, 'error' => string, ...diagnostics]
     *               Errors: empty_init_data | bot_token_missing | malformed_init_data |
     *               hash_missing | bad_signature | auth_date_missing | auth_date_expired
     */
    public static function validate(string $initData, string $botToken, array $options = []): array
    {
        $initData = trim($initData);
        if ($initData === '') {
            return ['ok' => false, 'error' => 'empty_init_data'];
        }

        $botToken = trim($botToken);
        if ($botToken === '') {
            return ['ok' => false, 'error' => 'bot_token_missing'];
        }

        parse_str($initData, $raw);
        if (!is_array($raw) || $raw === []) {
            return ['ok' => false, 'error' => 'malformed_init_data'];
        }

        // Telegram never sends array values here; degrade defensively instead
        // of letting a (string) cast on an array crash the endpoint.
        $fields = [];
        foreach ($raw as $k => $v) {
            $fields[(string) $k] = is_array($v) ? json_encode($v) : (string) $v;
        }

        $hash = $fields['hash'] ?? '';
        if ($hash === '') {
            return ['ok' => false, 'error' => 'hash_missing', 'fields' => $fields];
        }
        unset($fields['hash']);

        $dataCheckString = self::dataCheckString($fields);
        if (!hash_equals(self::signature($dataCheckString, $botToken), $hash)) {
            return ['ok' => false, 'error' => 'bad_signature', 'hash' => $hash, 'fields' => $fields];
        }

        $authDate = (int) ($fields['auth_date'] ?? 0);
        $maxAge   = (int) ($options['max_age'] ?? self::DEFAULT_MAX_AGE);
        if ($maxAge > 0) {
            if ($authDate <= 0) {
                return ['ok' => false, 'error' => 'auth_date_missing', 'fields' => $fields];
            }
            if (time() - $authDate > $maxAge) {
                return ['ok' => false, 'error' => 'auth_date_expired', 'auth_date' => $authDate];
            }
        }

        $out = [
            'ok'          => true,
            'auth_date'   => $authDate,
            'user'        => null,
            'start_param' => $fields['start_param'] ?? null,
            'fields'      => $fields,
            'hash'        => $hash,
        ];

        if (isset($fields['user'])) {
            $user = json_decode($fields['user'], true);
            if (is_array($user)) {
                $out['user'] = $user;
            }
        }

        return $out;
    }

    /**
     * Validate and reduce to a boolean.
     *
     * @param string $initData Raw initData string
     * @param string $botToken Bot token
     * @param array{max_age?:int} $options
     */
    public static function valid(string $initData, string $botToken, array $options = []): bool
    {
        return self::validate($initData, $botToken, $options)['ok'];
    }

    /**
     * Validate and return only the Mini App user (or null when invalid).
     *
     * @param string $initData Raw initData string
     * @param string $botToken Bot token
     * @param array{max_age?:int} $options
     * @return array<string,mixed>|null ['id' => int, 'first_name' => string, ...]
     */
    public static function user(string $initData, string $botToken, array $options = []): ?array
    {
        $res = self::validate($initData, $botToken, $options);

        return $res['ok'] ? $res['user'] : null;
    }

    /**
     * Build a correctly-signed initData string — for tests, fixtures and
     * local development (e.g. curl-ing your Mini App endpoint before wiring
     * the real frontend). Values that are arrays are JSON-encoded (the `user`
     * field). `auth_date` defaults to now; `hash` is computed and appended.
     *
     * @param array<string,mixed> $fields   Field => value (scalar or array)
     * @param string              $botToken Bot token to sign with
     */
    public static function build(array $fields, string $botToken): string
    {
        unset($fields['hash']);

        if (isset($fields['user']) && !is_string($fields['user'])) {
            $fields['user'] = json_encode($fields['user'], JSON_UNESCAPED_UNICODE);
        }
        $fields += ['auth_date' => (string) time()];

        $signed = [];
        foreach ($fields as $k => $v) {
            $signed[(string) $k] = is_array($v) ? json_encode($v, JSON_UNESCAPED_UNICODE) : (string) $v;
        }

        $hash = self::signature(self::dataCheckString($signed), $botToken);

        return http_build_query($signed) . '&hash=' . $hash;
    }

    /**
     * Data-check-string: `key=value` lines sorted alphabetically by key,
     * joined with "\n" — exactly as the official Telegram algorithm defines.
     *
     * @param array<string,string> $fields Fields WITHOUT the hash
     */
    private static function dataCheckString(array $fields): string
    {
        $pairs = [];
        foreach ($fields as $k => $v) {
            $pairs[] = $k . '=' . $v;
        }
        sort($pairs, SORT_STRING);

        return implode("\n", $pairs);
    }

    /**
     * Computed HMAC hex digest for a data-check-string.
     * secret_key = HMAC_SHA256(key="WebAppData", message=bot_token)
     * digest     = HMAC_SHA256(key=secret_key, message=data_check_string)
     */
    private static function signature(string $dataCheckString, string $botToken): string
    {
        $secret = hash_hmac('sha256', $botToken, 'WebAppData', true);

        return hash_hmac('sha256', $dataCheckString, $secret);
    }
}
