<?php
namespace telegramBotApiPhp\Types;

/**
 * Class TransactionPartner
 * This object describes the source of a transaction, or its recipient for outgoing transactions. Currently, it can be one of:
 *
 * @property string $type Type of the transaction partner, always “user” or “chat” or “fragment”
 * @property User|null $user Information about the user (only for “user” type)
 * @property AffiliateInfo|null $affiliate Information about the affiliate that received a commission via this transaction (only for “user” type)
 * @property string|null $invoice_payload Bot-specified invoice payload (only for “user” type)
 * @property int|null $subscription_period Duration of the paid subscription (only for “user” type)
 * @property PaidMedia[]|null $paid_media Information about the paid media bought by the user (only for “user” type)
 * @property string|null $paid_media_payload Bot-specified paid media payload (only for “user” type)
 * @property Gift|null $gift The gift sent to the user (only for “user” type) or chat (only for “chat” type)
 * @property Chat|null $chat Information about the chat (only for “chat” type)
 * @property User|null $sponsor_user Information about the bot that sponsored the affiliate program (only for “fragment” type)
 * @property int|null $commission_per_mille The number of Telegram Stars received by the bot for each 1000 Telegram Stars received by the affiliate program sponsor from referred users (only for “fragment” type)
 * @property RevenueWithdrawalState|null $withdrawal_state State of the transaction if the transaction is outgoing (only for “fragment” type)
 * @property int|null $request_count The number of successful requests that exceeded regular limits and were therefore billed (only for “fragment” type)
 */
class TransactionPartner extends BaseType
{
}
