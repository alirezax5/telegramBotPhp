# Métodos da API (186)

Todo método é público em `Telegram` (misturado via a trait agregadora `method`).
Os métodos retornam um objeto tipado `returned*` criado com `BaseType::create()`.

Convenções de tipo de retorno:
- `returned`                       → resultado bool escalar
- `returnedMessage`               → um único Message
- `returned*` demais → wrapper de resposta/entidade correspondente

## Trait: Updates (polling e webhook) — 7

`getUpdates`, `setWebhook`, `deleteWebhook`, `getWebhookInfo`, `getMe`, `logOut`, `close`

## Trait: Messages — 45

`sendMessage`, `forwardMessage`, `copyMessage`, `forwardMessages`, `copyMessages`,
`deleteMessage`, `deleteMessages`, `sendChatAction`, `setMessageReaction`,
`deleteMessageReaction`, `deleteAllMessageReactions`, `sendPhoto`, `sendLivePhoto`,
`sendAudio`, `sendDocument`, `sendVideo`, `sendAnimation`, `sendVoice`,
`sendVideoNote`, `sendPaidMedia`, `sendMediaGroup`, `sendLocation`, `sendVenue`,
`sendContact`, `sendPoll`, `sendDice`, `sendMessageDraft`, `sendChecklist`,
`editMessageText`, `editMessageCaption`, `editMessageMedia`, `editMessageLiveLocation`,
`stopMessageLiveLocation`, `editMessageChecklist`, `editMessageReplyMarkup`,
`stopPoll`, `approveSuggestedPost`, `declineSuggestedPost`,
**efêmero:** `deleteEphemeralMessage`, `editEphemeralMessageText`,
`editEphemeralMessageCaption`, `editEphemeralMessageMedia`, `editEphemeralMessageReplyMarkup`,
**rich:** `sendRichMessage`, `sendRichMessageDraft`

## Trait: ChatAdministration — 51

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

## Trait: Stickers — 16

`sendSticker`, `getStickerSet`, `getCustomEmojiStickers`, `uploadStickerFile`,
`createNewStickerSet`, `addStickerToSet`, `setStickerPositionInSet`,
`deleteStickerFromSet`, `replaceStickerInSet`, `setStickerEmojiList`,
`setStickerKeywords`, `setStickerMaskPosition`, `setStickerSetTitle`,
`setStickerSetThumbnail`, `setCustomEmojiStickerSetThumbnail`, `deleteStickerSet`

## Trait: PaymentsAndGames — 11

`sendInvoice`, `createInvoiceLink`, `answerShippingQuery`, `answerPreCheckoutQuery`,
`getMyStarBalance`, `getStarTransactions`, `refundStarPayment`,
`editUserStarSubscription`, `sendGame`, `setGameScore`, `getGameHighScores`

## Trait: Business — 36

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

## Trait: BotSettings — 20

`setMyCommands` `deleteMyCommands` `getMyCommands`, `setMyName`, `getMyName`,
`setMyDescription`, `getMyDescription`, `setMyShortDescription`,
`getMyShortDescription`, `setMyProfilePhoto`, `removeMyProfilePhoto`,
`setChatMenuButton`, `getChatMenuButton`, `setMyDefaultAdministratorRights`,
`getMyDefaultAdministratorRights`, `setPassportDataErrors`, `getUserProfilePhotos`,
`getUserProfileAudios`, `setUserEmojiStatus`, `getFile`

## Traits de verificação de tipo e de conveniência (não são métodos da API)

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
- `Telegram` núcleo (não API): `setToken`, `getToken`, `switchToken`, `restoreToken`,
  `clearTokenStack`, `getTokenStackCount`, `bot`, `close`, `__destruct`,
  `getFileUrl`, `getInputData`, `setInputData`, `clearCache`, getters de update tipados,
  `checkUpdateExists`, `getUpdateId`
- trait `method`: `callRaw` (público), `call` privado, `prepareBotData`,
  `prepareMediaForUpload`, `prepareFileInput`, `prepareMediaGroup`

## Total

- 7 + 45 + 57 + 16 + 11 + 36 + 20 = **186 métodos da API**
- 199 tipos de resposta/entidade
