<div dir="rtl">

# متدهای API (186)

هر متد روی `Telegram` عمومی است (از طریق تریت تجمیع‌گر `method` مخلوط می‌شود).
متدها یک شیء تایپ‌شده `returned*` برمی‌گردانند که با `BaseType::create()` ساخته می‌شود.

قراردادهای نوع بازگشتی:
- `returned`                       → نتیجه بولین اسکالر
- `returnedMessage`               → یک Message واحد
- سایر `returned*`ها → پوشش پاسخ/موجودیت متناظر

## تریت: Updates (polling و webhook) — 7

`getUpdates`, `setWebhook`, `deleteWebhook`, `getWebhookInfo`, `getMe`, `logOut`, `close`

## تریت: Messages — 45

`sendMessage`, `forwardMessage`, `copyMessage`, `forwardMessages`, `copyMessages`,
`deleteMessage`, `deleteMessages`, `sendChatAction`, `setMessageReaction`,
`deleteMessageReaction`, `deleteAllMessageReactions`, `sendPhoto`, `sendLivePhoto`,
`sendAudio`, `sendDocument`, `sendVideo`, `sendAnimation`, `sendVoice`,
`sendVideoNote`, `sendPaidMedia`, `sendMediaGroup`, `sendLocation`, `sendVenue`,
`sendContact`, `sendPoll`, `sendDice`, `sendMessageDraft`, `sendChecklist`,
`editMessageText`, `editMessageCaption`, `editMessageMedia`, `editMessageLiveLocation`,
`stopMessageLiveLocation`, `editMessageChecklist`, `editMessageReplyMarkup`,
`stopPoll`, `approveSuggestedPost`, `declineSuggestedPost`,
**ephemeral:** `deleteEphemeralMessage`, `editEphemeralMessageText`,
`editEphemeralMessageCaption`, `editEphemeralMessageMedia`, `editEphemeralMessageReplyMarkup`,
**rich:** `sendRichMessage`, `sendRichMessageDraft`

## تریت: ChatAdministration — 51

`banChatMember`, `unbanChatMember`, `restrictChatMember`, `promoteChatMember`,
`setChatAdministratorCustomTitle`, `setChatMemberTag`, `banChatSenderChat`,
`unbanChatSenderChat`, `setChatPermissions`, `exportChatInviteLink`,
`createChatInviteLink`, `editChatInviteLink`, `createChatSubscriptionInviteLink`,
`editChatSubscriptionInviteLink`, `revokeChatInviteLink`, `approveChatJoinRequest`,
`declineChatJoinRequest`, `setChatPhoto`, `deleteChatPhoto`, `setChatTitle`,
`setChatDescription`, `pinChatMessage`, `unpinChatMessage`, `unpinAllChatMessages`,
`leaveChat`, `getChat`, `getChatAdministrators`, `getChatMemberCount`,
`getChatMembersCount`, `getUserPersonalChatMessages`, `setChatStickerSet`,
`deleteChatStickerSet`, `getForumTopicIconStickers`, `createForumTopic`,
`editForumTopic`, `closeForumTopic`, `reopenForumTopic`, `deleteForumTopic`,
`unpinAllForumTopicMessages`, `editGeneralForumTopic`, `closeGeneralForumTopic`,
`reopenGeneralForumTopic`, `hideGeneralForumTopic`, `unhideGeneralForumTopic`,
`unpinAllGeneralForumTopicMessages`, `answerCallbackQuery`, `answerGuestQuery`,
`getUserChatBoosts`, `getChatMember`, `answerChatJoinRequestQuery`,
`sendChatJoinRequestWebApp`

## تریت: Stickers — 16

`sendSticker`, `getStickerSet`, `getCustomEmojiStickers`, `uploadStickerFile`,
`createNewStickerSet`, `addStickerToSet`, `setStickerPositionInSet`,
`deleteStickerFromSet`, `replaceStickerInSet`, `setStickerEmojiList`,
`setStickerKeywords`, `setStickerMaskPosition`, `setStickerSetTitle`,
`setStickerSetThumbnail`, `setCustomEmojiStickerSetThumbnail`, `deleteStickerSet`

## تریت: PaymentsAndGames — 11

`sendInvoice`, `createInvoiceLink`, `answerShippingQuery`, `answerPreCheckoutQuery`,
`getMyStarBalance`, `getStarTransactions`, `refundStarPayment`,
`editUserStarSubscription`, `sendGame`, `setGameScore`, `getGameHighScores`

## تریت: Business — 36

`getBusinessConnection`, `readBusinessMessage`, `deleteBusinessMessages`,
`setBusinessAccountName`, `setBusinessAccountUsername`, `setBusinessAccountBio`,
`setBusinessAccountProfilePhoto`, `removeBusinessAccountProfilePhoto`,
`setBusinessAccountGiftSettings`, `getBusinessAccountStarBalance`,
`transferBusinessAccountStars`, `getBusinessAccountGifts`, `getManagedBotToken`,
`getManagedBotAccessSettings`, `replaceManagedBotToken`, `setManagedBotAccessSettings`,
`sendGift`, `giftPremiumSubscription`, `getAvailableGifts`, `getUserGifts`,
`getChatGifts`, `convertGiftToStars`, `upgradeGift`, `transferGift`, `postStory`,
`repostStory`, `editStory`, `deleteStory`, `answerWebAppQuery`,
`savePreparedInlineMessage`, `savePreparedKeyboardButton`, `answerInlineQuery`,
`verifyUser`, `verifyChat`, `removeUserVerification`, `removeChatVerification`

## تریت: BotSettings — 20

`setMyCommands` `deleteMyCommands` `getMyCommands`, `setMyName`, `getMyName`,
`setMyDescription`, `getMyDescription`, `setMyShortDescription`,
`getMyShortDescription`, `setMyProfilePhoto`, `removeMyProfilePhoto`,
`setChatMenuButton`, `getChatMenuButton`, `setMyDefaultAdministratorRights`,
`getMyDefaultAdministratorRights`, `setPassportDataErrors`, `getUserProfilePhotos`,
`getUserProfileAudios`, `setUserEmojiStatus`, `getFile`

## تریت‌های چکر تایپ و کمکی (متدهای API نیستند)

- `isUpdates` (23): `isMessage`, `isEditedMessage`, `isChannelPost`, `isEditedChannelPost`,
  `isBusiness`, `isBusinessMessage`, `isEditedBusinessMessage`,
  `isDeletedBusinessMessages`, `isMessageReaction`, `isMessageReactionCount`,
  `isInlineQuery`, `isChosenInlineResult`, `isCallbackQuery`, `isShippingQuery`,
  `isPreCheckoutQuery`, `isPurchasedPaidMedia`, `isPoll`, `isPollAnswer`,
  `isChatJoinRequest`, `isMyChatMember`, `isChatMember`, `isChatBoost`,
  `isRemovedChatBoost`
- `isChatTypes` (4): `isPrivate`, `isGroup`, `isSupergroup`, `isChannel`
- `isMedia` (12): `isVideo`, `isPhoto`, `isAudio`, `isVoice`, `isAnimation`,
  `isVideoNote`, `isContact`, `isDocument`, `isSticker`, `isGame`, `isLocation`, `isMedia`
- `otherTrait` (19): `messageID`, `text`, `caption`, `fromId`, `chatId`, `firstName`,
  `lastName`, `username`, `languageCode`, `isPremium`, `chatType`, `msgType`,
  `mediaType`, `fileId`, `mimeType`, `fileSize`, `isReply`, `replyToMessageId`,
  `pathToUrl`
- هسته `Telegram` (غیر API): `setToken`, `getToken`, `switchToken`, `restoreToken`,
  `clearTokenStack`, `getTokenStackCount`, `bot`, `close`, `__destruct`,
  `getFileUrl`, `getInputData`, `setInputData`, `clearCache`, گترهای تایپ‌شده آپدیت,
  `checkUpdateExists`, `getUpdateId`
- تریت `method`: `callRaw` (عمومی)، `call` خصوصی، `prepareBotData`,
  `prepareMediaForUpload`, `prepareFileInput`, `prepareMediaGroup`

## جمع کل

- 7 + 45 + 57 + 16 + 11 + 36 + 20 = **186 متد API**
- 199 تایپ پاسخ/موجودیت

</div>
