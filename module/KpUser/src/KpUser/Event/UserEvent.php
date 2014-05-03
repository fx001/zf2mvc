<?php
/**
 * Kittencup (http://www.kittencup.com/)
 * @date 2014 14-4-27 下午1:13
 */

namespace KpUser\Event;

use KpUser\Entity\UserEntity;
use KpUser\Options\UserModuleOptions;
use Zend\Authentication\Result;
use Zend\EventManager\Event;
use Zend\Form\FormInterface;
use Zend\Stdlib\AbstractOptions;

class UserEvent extends Event
{
    const USER_REG_PRE = 'user.reg.pre';
    const USER_REG_POST = 'user.reg.post';
    const USER_REG_ERROR = 'user.reg.error';

    const USER_LOGIN_ERROR = 'user.login.error';
    const USER_LOGIN_PRE = 'user.login.pre';
    const USER_LOGIN_POST = 'user.login.post';

    public function getUserEntity()
    {
        return $this->getParam('userEntity');
    }

    public function setUserEntity(UserEntity $userEntity)
    {
        $this->setParam('userEntity', $userEntity);
        return $this;
    }

    public function setForm(FormInterface $form)
    {
        $this->setParam('form', $form);
        return $this;
    }

    public function getForm()
    {
        return $this->getParam('form');
    }

    public function setUserModuleOptions(AbstractOptions $options)
    {
        $this->setParam('userModuleOptions', $options);
        return $this;
    }

    public function getUserModuleOptions()
    {
        return $this->getParam('userModuleOptions', new UserModuleOptions());
    }

    public function setResult(Result $result)
    {
        $this->setParam('result', $result);
        return $this;
    }

    public function getResult()
    {
        return $this->getParam('result');
    }
}