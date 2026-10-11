# Vue d'ensemble du projet

**telegramBotPhp** est un wrapper PHP 8.1+ léger et sans aucune dépendance pour l'API Bot de Telegram.

## Objectif

Exposer chaque méthode de l'API Bot de Telegram à travers une surface PHP orientée objet et ergonomique, tout en conservant une empreinte d'exécution minimale (PHP + cURL uniquement — aucun paquet externe, aucun framework).

## Périmètre et chiffres

| Métrique | Valeur |
|--------|-------|
| Méthodes de l'API Bot couvertes | **186** |
| Classes de réponses/entités typées | **199** |
| Version de PHP | >= 8.1 |
| Dépendances d'exécution | **0** (utilise `ext-curl`, `ext-json`) |
| Style des données | Autoload PSR-4 ; décodage `stdClass` + wrappers typés paresseux |

## Extension de l'API

Le wrapper associe chaque endpoint à une **méthode** sur `Telegram` (mixée via des *traits* métier), et chaque réponse/entité JSON à une classe de **type** sous `src/Types/`.

## Objectifs de conception

1. **Exhaustivité** — rester en phase avec l'API Bot officielle à l'adresse `https://core.telegram.org/bots/api`.
2. **Ergonomie** — des getters conviviaux (`text()`, `chatId()`, `mediaType()`) par-dessus les objets bruts.
3. **Fiabilité** — reprise HTTP intégrée avec backoff exponentiel + gestion de `retry_after`, handle cURL réutilisable, prise en charge du timeout du long polling.
4. **Aucun enfermement** — aucune dépendance à un framework ; utilisable depuis des scripts webhook ou de long polling.

Voir [folder-structure.md](folder-structure.md) pour l'organisation des dossiers, [methods.md](methods.md) pour la surface d'API, et [telegram-class.md](telegram-class.md) pour la classe centrale.
