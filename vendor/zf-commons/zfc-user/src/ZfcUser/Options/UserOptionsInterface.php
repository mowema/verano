<?php

namespace ZfcUser\Options;

interface UserOptionsInterface
{
    /**
     * set enable display name
     *
     * @param bool $flag
     * @return ModuleOptions
     */
    public function setEnableDisplayName($enableDisplayName);

    /**
     * get enable display name
     *
     * @return bool
     */
    public function getEnableDisplayName();

    /**
     * set enable user registration
     *
     * @param bool $enableRegistration
     */
    public function setEnableUser($enableUser);

    /**
     * get enable user registration
     *
     * @return bool
     */
    public function getEnableUser();

    /**
     * set enable username
     *
     * @param bool $flag
     * @return ModuleOptions
     */
    public function setEnableUsername($enableUsername);

    /**
     * get enable username
     *
     * @return bool
     */
    public function getEnableUsername();

    /**
     * set user form timeout in seconds
     *
     * @param int $userFormTimeout
     */
    public function setUserFormTimeout($userFormTimeout);

    /**
     * get user form timeout in seconds
     *
     * @return int
     */
    public function getUserFormTimeout();

    /**
     * set use a captcha in registration form
     *
     * @param bool $useRegistrationFormCaptcha
     * @return ModuleOptions
     */
    public function setUseUserFormCaptcha($useUserFormCaptcha);

    /**
     * get use a captcha in registration form
     *
     * @return bool
     */
    public function getUseUserFormCaptcha();

    /**
     * set login after registration
     *
     * @param bool $loginAfterRegistration
     * @return ModuleOptions
     */
    public function setLoginAfterUser($loginAfterUser);

    /**
     * get login after registration
     *
     * @return bool
     */
    public function getLoginAfterUser();

    /**
     * set form CAPTCHA options
     *
     * @param array $formCaptchaOptions
     * @return ModuleOptions
     */
    public function setFormCaptchaOptions($formCaptchaOptions);

    /**
     * get form CAPTCHA options
     *
     * @return array
     */
    public function getFormCaptchaOptions();
}
