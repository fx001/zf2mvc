<?php
namespace KpUser\Options;

use Zend\Stdlib\AbstractOptions;

class UserModuleOptions extends AbstractOptions{
    protected $disabledReg = false;

    protected $disabledLogin = false;

    protected $regWelcomeEmail = false;

    protected $emailValidate = false;

    protected $passwordErrorCount = 5;

    protected $passwordErrorTime = 3600;

    protected $identityKey = 'username';
    /**
     * @param boolean $disabledLogin
     */
    public function setDisabledLogin($disabledLogin)
    {
        $this->disabledLogin = $disabledLogin;
    }

    /**
     * @return boolean
     */
    public function getDisabledLogin()
    {
        return $this->disabledLogin;
    }

    /**
     * @param boolean $disabledReg
     */
    public function setDisabledReg($disabledReg)
    {
        $this->disabledReg = $disabledReg;
    }

    /**
     * @return boolean
     */
    public function getDisabledReg()
    {
        return $this->disabledReg;
    }

    /**
     * @param boolean $emailValidate
     */
    public function setEmailValidate($emailValidate)
    {
        $this->emailValidate = $emailValidate;
    }

    /**
     * @return boolean
     */
    public function getEmailValidate()
    {
        return $this->emailValidate;
    }

    /**
     * @param string $identityKey
     */
    public function setIdentityKey($identityKey)
    {
        $this->identityKey = $identityKey;
    }

    /**
     * @return string
     */
    public function getIdentityKey()
    {
        return $this->identityKey;
    }

    /**
     * @param int $passwordErrorCount
     */
    public function setPasswordErrorCount($passwordErrorCount)
    {
        $this->passwordErrorCount = $passwordErrorCount;
    }

    /**
     * @return int
     */
    public function getPasswordErrorCount()
    {
        return $this->passwordErrorCount;
    }

    /**
     * @param int $passwordErrorTime
     */
    public function setPasswordErrorTime($passwordErrorTime)
    {
        $this->passwordErrorTime = $passwordErrorTime;
    }

    /**
     * @return int
     */
    public function getPasswordErrorTime()
    {
        return $this->passwordErrorTime;
    }

    /**
     * @param boolean $regWelcomeEmail
     */
    public function setRegWelcomeEmail($regWelcomeEmail)
    {
        $this->regWelcomeEmail = $regWelcomeEmail;
    }

    /**
     * @return boolean
     */
    public function getRegWelcomeEmail()
    {
        return $this->regWelcomeEmail;
    }
}