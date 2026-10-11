<div dir="rtl">

# أساليب الـ API‏ (186)

كل أسلوب عام (public) على الصنف `Telegram` (يُمزج عبر trait التجميع `method`).
تُعيد الأساليب كائن `returned*` ممنوحًا بالأنواع يُنشأ عبر `BaseType::create()`.

اصطلاحات نوع الإرجاع:
- `returned`                       → نتيجة منطقية (bool) عدّية
- `returnedMessage`               → كائن Message واحد
- `returned*` الباقية → غلاف استجابة/كيان مطابق

## Trait‏: Updates (الاستطلاع والويب هوك) — 7

`getUpdates`، `setWebhook`، `deleteWebhook`، `getWebhookInfo`، `getMe`، `logOut`، `close`

## Trait‏: Messages — 45

`sendMessage`، `forwardMessage`، `copyMessage`، `forwardMessages`، `copyMessages`،
`deleteMessage`، `deleteMessages`، `sendChatAction`، `setMessageReaction`،
`deleteMessageReaction`، `deleteAllMessageReactions`، `sendPhoto`، `sendLivePhoto`،
`sendAudio`، `sendDocument`، `sendVideo`، `sendAnimation`، `sendVoice`،
`sendVideoNote`، `sendPaidMedia`، `sendMediaGroup`، `sendLocation`، `sendVenue`،
`sendContact`، `sendPoll`، `sendDice`، `sendMessageDraft`، `sendChecklist`،
`editMessageText`، `editMessageCaption`، `editMessageMedia`، `editMessageLiveLocation`،
`stopMessageLiveLocation`، `editMessageChecklist`، `editMessageReplyMarkup`،
`stopPoll`، `approveSuggestedPost`، `declineSuggestedPost`،
**مؤقتة (ephemeral):** `deleteEphemeralMessage`، `editEphemeralMessageText`،
`editEphemeralMessageCaption`، `editEphemeralMessageMedia`، `editEphemeralMessageReplyMarkup`،
**غنية (rich):** `sendRichMessage`، `sendRichMessageDraft`

## Trait‏: ChatAdministration — 51

`banChatMember`، `unbanChatMember`، `restrictChatMember`، `promoteChatMember`،
`setChatAdministratorCustomTitle`، `setChatMemberTag`، `banChatSenderChat`،
`unbanChatSenderChat`، `setChatPermissions`، `exportChatInviteLink`،
`createChatInviteLink`، `editChatInviteLink`، `createChatSubscriptionInviteLink`،
`editChatSubscriptionInviteLink`، `revokeChatInviteLink`، `approveChatJoinRequest`،
`declineChatJoinRequest`، `setChatPhoto`، `deleteChatPhoto`، `setChatTitle`،
`setChatDescription`، `pinChatMessage`، `unpinChatMessage`، `unpinAllChatMessages`،
`leaveChat`، `getChat`، `getChatAdministrators`، `getChatMemberCount`،
`getChatMembersCount`، `getUserPersonalChatMessages`، `setChatStickerSet`،
`deleteChatStickerSet`، `getForumTopicIconStickers`، `createForumTopic`،
`editForumTopic`، `closeForumTopic`، `reopenForumTopic`، `deleteForumTopic`،
`unpinAllForumTopicMessages`، `editGeneralForumTopic`، `closeGeneralForumTopic`،
`reopenGeneralForumTopic`، `hideGeneralForumTopic`، `unhideGeneralForumTopic`،
`unpinAllGeneralForumTopicMessages`، `answerCallbackQuery`، `answerGuestQuery`،
`getUserChatBoosts`، `getChatMember`، `answerChatJoinRequestQuery`،
`sendChatJoinRequestWebApp`

## Trait‏: Stickers — 16

`sendSticker`، `getStickerSet`، `getCustomEmojiStickers`، `uploadStickerFile`،
`createNewStickerSet`، `addStickerToSet`، `setStickerPositionInSet`،
`deleteStickerFromSet`، `replaceStickerInSet`، `setStickerEmojiList`،
`setStickerKeywords`، `setStickerMaskPosition`، `setStickerSetTitle`،
`setStickerSetThumbnail`، `setCustomEmojiStickerSetThumbnail`، `deleteStickerSet`

## Trait‏: PaymentsAndGames — 11

`sendInvoice`، `createInvoiceLink`، `answerShippingQuery`، `answerPreCheckoutQuery`،
`getMyStarBalance`، `getStarTransactions`، `refundStarPayment`،
`editUserStarSubscription`، `sendGame`، `setGameScore`، `getGameHighScores`

## Trait‏: Business — 36

`getBusinessConnection`، `readBusinessMessage`، `deleteBusinessMessages`،
`setBusinessAccountName`، `setBusinessAccountUsername`، `setBusinessAccountBio`،
`setBusinessAccountProfilePhoto`، `removeBusinessAccountProfilePhoto`،
`setBusinessAccountGiftSettings`، `getBusinessAccountStarBalance`،
`transferBusinessAccountStars`، `getBusinessAccountGifts`، `getManagedBotToken`،
`getManagedBotAccessSettings`، `replaceManagedBotToken`، `setManagedBotAccessSettings`،
`sendGift`، `giftPremiumSubscription`، `getAvailableGifts`، `getUserGifts`،
`getChatGifts`، `convertGiftToStars`، `upgradeGift`، `transferGift`، `postStory`،
`repostStory`، `editStory`، `deleteStory`، `answerWebAppQuery`،
`savePreparedInlineMessage`، `savePreparedKeyboardButton`، `answerInlineQuery`،
`verifyUser`، `verifyChat`، `removeUserVerification`، `removeChatVerification`

## Trait‏: BotSettings — 20

`setMyCommands` `deleteMyCommands` `getMyCommands`، `setMyName`، `getMyName`،
`setMyDescription`، `getMyDescription`، `setMyShortDescription`،
`getMyShortDescription`، `setMyProfilePhoto`، `removeMyProfilePhoto`،
`setChatMenuButton`، `getChatMenuButton`، `setMyDefaultAdministratorRights`،
`getMyDefaultAdministratorRights`، `setPassportDataErrors`، `getUserProfilePhotos`،
`getUserProfileAudios`، `setUserEmojiStatus`، `getFile`

## traits التحقق من الأنواع وtraits الملاءمة (ليست أساليب API)

- `isUpdates`‏ (23): `isMessage`، `isEditedMessage`، `isChannelPost`، `isEditedChannelPost`،
  `isBusiness`، `isBusinessMessage`، `isEditedBusinessMessage`،
  `isDeletedBusinessMessages`، `isMessageReaction`، `isMessageReactionCount`،
  `isInlineQuery`، `isChosenInlineResult`، `isCallbackQuery`، `isShippingQuery`،
  `isPreCheckoutQuery`، `isPurchasedPaidMedia`، `isPoll`، `isPollAnswer`،
  `isChatJoinRequest`، `isMyChatMember`، `isChatMember`، `isChatBoost`،
  `isRemovedChatBoost`
- `isChatTypes`‏ (4): `isPrivate`، `isGroup`، `isSupergroup`، `isChannel`
- `isMedia`‏ (12): `isVideo`، `isPhoto`، `isAudio`، `isVoice`، `isAnimation`،
  `isVideoNote`، `isContact`، `isDocument`، `isSticker`، `isGame`، `isLocation`، `isMedia`
- `otherTrait`‏ (19): `messageID`، `text`، `caption`، `fromId`، `chatId`، `firstName`،
  `lastName`، `username`، `languageCode`، `isPremium`، `chatType`، `msgType`،
  `mediaType`، `fileId`، `mimeType`، `fileSize`، `isReply`، `replyToMessageId`،
  `pathToUrl`
- نواة `Telegram`‏ (غير تابعة للـ API): `setToken`، `getToken`، `switchToken`، `restoreToken`،
  `clearTokenStack`، `getTokenStackCount`، `bot`، `close`، `__destruct`،
  `getFileUrl`، `getInputData`، `setInputData`، `clearCache`، دوال وصول التحديث الممنوحة بالأنواع،
  `checkUpdateExists`، `getUpdateId`
- trait‏ `method`:‏ `callRaw` (عامة)، و`call` خاصة، و`prepareBotData`،
  `prepareMediaForUpload`، `prepareFileInput`، `prepareMediaGroup`

## الإجمالي

- 7 + 45 + 57 + 16 + 11 + 36 + 20 = **186 أسلوب API**
- 199 نوع استجابة/كيان

</div>
