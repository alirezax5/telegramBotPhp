# API 方法（186）

每个方法在 `Telegram` 上都是公有的（通过 `method` 聚合器 trait 混入）。
方法返回由 `BaseType::create()` 创建的类型化 `returned*` 对象。

返回类型约定：
- `returned`                       → 标量 bool 结果
- `returnedMessage`               → 单个 Message
- `returned*` 其他 → 对应的响应/实体包装器

## Trait：Updates（轮询与 Webhook）— 7

`getUpdates`、`setWebhook`、`deleteWebhook`、`getWebhookInfo`、`getMe`、`logOut`、`close`

## Trait：Messages — 45

`sendMessage`、`forwardMessage`、`copyMessage`、`forwardMessages`、`copyMessages`、
`deleteMessage`、`deleteMessages`、`sendChatAction`、`setMessageReaction`、
`deleteMessageReaction`、`deleteAllMessageReactions`、`sendPhoto`、`sendLivePhoto`、
`sendAudio`、`sendDocument`、`sendVideo`、`sendAnimation`、`sendVoice`、
`sendVideoNote`、`sendPaidMedia`、`sendMediaGroup`、`sendLocation`、`sendVenue`、
`sendContact`、`sendPoll`、`sendDice`、`sendMessageDraft`、`sendChecklist`、
`editMessageText`、`editMessageCaption`、`editMessageMedia`、`editMessageLiveLocation`、
`stopMessageLiveLocation`、`editMessageChecklist`、`editMessageReplyMarkup`、
`stopPoll`、`approveSuggestedPost`、`declineSuggestedPost`、
**临时消息（ephemeral）：** `deleteEphemeralMessage`、`editEphemeralMessageText`、
`editEphemeralMessageCaption`、`editEphemeralMessageMedia`、`editEphemeralMessageReplyMarkup`、
**富文本消息（rich）：** `sendRichMessage`、`sendRichMessageDraft`

## Trait：ChatAdministration — 51

`banChatMember`、`unbanChatMember`、`restrictChatMember`、`promoteChatMember`、
`setChatAdministratorCustomTitle`、`setChatMemberTag`、`banChatSenderChat`、
`unbanChatSenderChat`、`setChatPermissions`、`exportChatInviteLink`、
`createChatInviteLink`、`editChatInviteLink`、`createChatSubscriptionInviteLink`、
`editChatSubscriptionInviteLink`、`revokeChatInviteLink`、`approveChatJoinRequest`、
`declineChatJoinRequest`、`setChatPhoto`、`deleteChatPhoto`、`setChatTitle`、
`setChatDescription`、`pinChatMessage`、`unpinChatMessage`、`unpinAllChatMessages`、
`leaveChat`、`getChat`、`getChatAdministrators`、`getChatMemberCount`、
`getChatMembersCount`、`getUserPersonalChatMessages`、`setChatStickerSet`、
`deleteChatStickerSet`、`getForumTopicIconStickers`、`createForumTopic`、
`editForumTopic`、`closeForumTopic`、`reopenForumTopic`、`deleteForumTopic`、
`unpinAllForumTopicMessages`、`editGeneralForumTopic`、`closeGeneralForumTopic`、
`reopenGeneralForumTopic`、`hideGeneralForumTopic`、`unhideGeneralForumTopic`、
`unpinAllGeneralForumTopicMessages`、`answerCallbackQuery`、`answerGuestQuery`、
`getUserChatBoosts`、`getChatMember`、`answerChatJoinRequestQuery`、
`sendChatJoinRequestWebApp`

## Trait：Stickers — 16

`sendSticker`、`getStickerSet`、`getCustomEmojiStickers`、`uploadStickerFile`、
`createNewStickerSet`、`addStickerToSet`、`setStickerPositionInSet`、
`deleteStickerFromSet`、`replaceStickerInSet`、`setStickerEmojiList`、
`setStickerKeywords`、`setStickerMaskPosition`、`setStickerSetTitle`、
`setStickerSetThumbnail`、`setCustomEmojiStickerSetThumbnail`、`deleteStickerSet`

## Trait：PaymentsAndGames — 11

`sendInvoice`、`createInvoiceLink`、`answerShippingQuery`、`answerPreCheckoutQuery`、
`getMyStarBalance`、`getStarTransactions`、`refundStarPayment`、
`editUserStarSubscription`、`sendGame`、`setGameScore`、`getGameHighScores`

## Trait：Business — 36

`getBusinessConnection`、`readBusinessMessage`、`deleteBusinessMessages`、
`setBusinessAccountName`、`setBusinessAccountUsername`、`setBusinessAccountBio`、
`setBusinessAccountProfilePhoto`、`removeBusinessAccountProfilePhoto`、
`setBusinessAccountGiftSettings`、`getBusinessAccountStarBalance`、
`transferBusinessAccountStars`、`getBusinessAccountGifts`、`getManagedBotToken`、
`getManagedBotAccessSettings`、`replaceManagedBotToken`、`setManagedBotAccessSettings`、
`sendGift`、`giftPremiumSubscription`、`getAvailableGifts`、`getUserGifts`、
`getChatGifts`、`convertGiftToStars`、`upgradeGift`、`transferGift`、`postStory`、
`repostStory`、`editStory`、`deleteStory`、`answerWebAppQuery`、
`savePreparedInlineMessage`、`savePreparedKeyboardButton`、`answerInlineQuery`、
`verifyUser`、`verifyChat`、`removeUserVerification`、`removeChatVerification`

## Trait：BotSettings — 20

`setMyCommands` `deleteMyCommands` `getMyCommands`、`setMyName`、`getMyName`、
`setMyDescription`、`getMyDescription`、`setMyShortDescription`、
`getMyShortDescription`、`setMyProfilePhoto`、`removeMyProfilePhoto`、
`setChatMenuButton`、`getChatMenuButton`、`setMyDefaultAdministratorRights`、
`getMyDefaultAdministratorRights`、`setPassportDataErrors`、`getUserProfilePhotos`、
`getUserProfileAudios`、`setUserEmojiStatus`、`getFile`

## 类型检查器与便捷 trait（非 API 方法）

- `isUpdates`（23）：`isMessage`、`isEditedMessage`、`isChannelPost`、`isEditedChannelPost`、
  `isBusiness`、`isBusinessMessage`、`isEditedBusinessMessage`、
  `isDeletedBusinessMessages`、`isMessageReaction`、`isMessageReactionCount`、
  `isInlineQuery`、`isChosenInlineResult`、`isCallbackQuery`、`isShippingQuery`、
  `isPreCheckoutQuery`、`isPurchasedPaidMedia`、`isPoll`、`isPollAnswer`、
  `isChatJoinRequest`、`isMyChatMember`、`isChatMember`、`isChatBoost`、
  `isRemovedChatBoost`
- `isChatTypes`（4）：`isPrivate`、`isGroup`、`isSupergroup`、`isChannel`
- `isMedia`（12）：`isVideo`、`isPhoto`、`isAudio`、`isVoice`、`isAnimation`、
  `isVideoNote`、`isContact`、`isDocument`、`isSticker`、`isGame`、`isLocation`、`isMedia`
- `otherTrait`（19）：`messageID`、`text`、`caption`、`fromId`、`chatId`、`firstName`、
  `lastName`、`username`、`languageCode`、`isPremium`、`chatType`、`msgType`、
  `mediaType`、`fileId`、`mimeType`、`fileSize`、`isReply`、`replyToMessageId`、
  `pathToUrl`
- `Telegram` 核心（非 API）：`setToken`、`getToken`、`switchToken`、`restoreToken`、
  `clearTokenStack`、`getTokenStackCount`、`bot`、`close`、`__destruct`、
  `getFileUrl`、`getInputData`、`setInputData`、`clearCache`、类型化的更新取值器、
  `checkUpdateExists`、`getUpdateId`
- `method` trait：`callRaw`（公有）、私有的 `call`、`prepareBotData`、
  `prepareMediaForUpload`、`prepareFileInput`、`prepareMediaGroup`

## 总计

- 7 + 45 + 57 + 16 + 11 + 36 + 20 = **186 个 API 方法**
- 199 个响应/实体类型
