<?php

declare(strict_types=1);

namespace telegramBotApiPhp\Traits;

use telegramBotApiPhp\Types\{
    returnedArrayBotCommand, returnedBotDescription, returnedBotName, returnedBotShortDescription, returnedChatAdministratorRights, returnedFile, returnedMenuButton, returnedUserProfileAudios, returnedUserProfilePhotos,returned
};

trait BotSettings
{


    /**
     * @return returned
     */
    public function setMyCommands($commands, array $options = []): returned
    {

        $data = compact('commands') + $options;

        return returned::create($this->call('setMyCommands', $data));
    }


    /**
     * @return returned
     */
    public function deleteMyCommands(array $options = []): returned
    {

        $data = $options;

        return returned::create($this->call('deleteMyCommands', $data));
    }


    /**
     * @return returnedArrayBotCommand
     */
    public function getMyCommands(array $options = []): returnedArrayBotCommand
    {

        $data = $options;

        return returnedArrayBotCommand::create($this->call('getMyCommands', $data));
    }



    /**
     * @return returned
     */
    public function setMyName($name = null, $language_code = null, array $options = []): returned
    {

        $data = compact('name', 'language_code') + $options;

        return returned::create($this->call('setMyName', $data));
    }


    /**
     * @return returnedBotName
     */
    public function getMyName($language_code = null, array $options = []): returnedBotName
    {

        $data = compact('language_code') + $options;

        return returnedBotName::create($this->call('getMyName', $data));
    }


    /**
     * @return returned
     */
    public function setMyDescription($description, array $options = []): returned
    {

        $data = compact('description') + $options;

        return returned::create($this->call('setMyDescription', $data));
    }


    /**
     * @return returnedBotDescription
     */
    public function getMyDescription($language_code = null, array $options = []): returnedBotDescription
    {

        $data = compact('language_code') + $options;

        return returnedBotDescription::create($this->call('getMyDescription', $data));
    }


    /**
     * @return returnedBotShortDescription
     */
    public function setMyShortDescription($short_description, $language_code = null, array $options = []): returnedBotShortDescription
    {

        $data = compact('short_description') + $options;

        return returnedBotShortDescription::create($this->call('setMyShortDescription', $data));
            }

            /**
             * Get the current bot short description for the given user language.
             * @return returnedBotShortDescription
             */
            public function getMyShortDescription($language_code = null, array $options = []): returnedBotShortDescription
            {
                $data = $options;
                if ($language_code !== null) {
                    $data['language_code'] = $language_code;
                }

                return returnedBotShortDescription::create($this->call('getMyShortDescription', $data));
            }


    /**
     * @return returned
     */
    public function setMyProfilePhoto($photo, array $options = []): returned
    {

        $data = compact('photo') + $options;

        return returned::create($this->call('setMyProfilePhoto', $data));
    }


    /**
     * @return returned
     */
    public function removeMyProfilePhoto(array $options = []): returned
    {

        $data = $options;

        return returned::create($this->call('removeMyProfilePhoto', $data));
    }



    /**
     * @return returned
     */
    public function setChatMenuButton(array $options = []): returned
    {

        $data = $options;

        return returned::create($this->call('setChatMenuButton', $data));
    }


    /**
     * @return returnedMenuButton
     */
    public function getChatMenuButton(array $options = []): returnedMenuButton
    {

        $data = $options;

        return returnedMenuButton::create($this->call('getChatMenuButton', $data));
    }


    /**
     * @return returned
     */
    public function setMyDefaultAdministratorRights(array $options = []): returned
    {

        $data = $options;

        return returned::create($this->call('setMyDefaultAdministratorRights', $data));
    }



    /**
     * @return returnedChatAdministratorRights
     */
    public function getMyDefaultAdministratorRights(array $options = []): returnedChatAdministratorRights
    {

        $data = $options;

        return returnedChatAdministratorRights::create($this->call('getMyDefaultAdministratorRights', $data));
    }



    /**
     * @return returned
     */
    public function setPassportDataErrors($user_id, $errors, array $options = []): returned
    {

        $data = compact('user_id', 'errors') + $options;

        return returned::create($this->call('setPassportDataErrors', $data));
    }


    /**
     * @return returnedUserProfilePhotos
     */

    public function getUserProfilePhotos($user_id, array $options = [])
    {
        $data = compact('user_id') + $options;

        return returnedUserProfilePhotos::create($this->call('getUserProfilePhotos', $data));
    }


    /**
     * @return returnedUserProfileAudios
     */

    public function getUserProfileAudios($user_id, array $options = [])
    {
        $data = compact('user_id') + $options;

        return returnedUserProfileAudios::create($this->call('getUserProfileAudios', $data));
    }


    /**
     * @return returnedUserProfileAudios
     */

    public function setUserEmojiStatus($user_id, array $options = [])
    {
        $data = compact('user_id') + $options;

        return returned::create($this->call('setUserEmojiStatus', $data));
    }


    /**
     * @return returnedFile
     */

    public function getFile($file_id, array $options = [])
    {
        $data = compact('file_id') + $options;

        return returnedFile::create($this->call('getFile', $data));
    }
}
