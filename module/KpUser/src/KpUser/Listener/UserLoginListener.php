<?php
/**
 * Kittencup (http://www.kittencup.com/)
 * @date 2014 14-4-27 下午1:22
 */

namespace KpUser\Listener;

use KpUser\Event\UserEvent;
use KpUser\Model\UserModel;
use Zend\Authentication\Result;
use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Validator\EmailAddress;

class UserLoginListener implements ListenerAggregateInterface
{
    protected $listeners = array();

    /**
     * @param EventManagerInterface $events
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->getSharedManager()->attach('*', UserEvent::USER_LOGIN_PRE, array($this, 'setIdentityKey'), 1000);
        $this->listeners[] = $events->getSharedManager()->attach('*', UserEvent::USER_LOGIN_PRE, array($this, 'checkStatus'), 10);

        $this->listeners[] = $events->getSharedManager()->attach('*', UserEvent::USER_LOGIN_POST, array($this, 'setLastLoginInfo'));
        $this->listeners[] = $events->getSharedManager()->attach('*', UserEvent::USER_LOGIN_ERROR, array($this, 'setErrorCount'));
    }

    /**
     * @param EventManagerInterface $events
     */
    public function detach(EventManagerInterface $events)
    {

    }


    public function setErrorCount(EventInterface $e)
    {
        $userModuleOptions = $e->getUserModuleOptions();

        $passwordErrorCount = $userModuleOptions->getPasswordErrorCount();

        if ($passwordErrorCount) {

            $result = $e->getResult();

            if ($result->getCode() === Result::FAILURE_CREDENTIAL_INVALID) {

                $userEntity = $e->getUserEntity();

                $serviceLocator = $e->getTarget()->getServiceLocator();

                $userTable = $serviceLocator->get('KpUser\Model\UserTable');

                $tableUserEntity = $userTable->getOneByField($userEntity->getUsername(), $userModuleOptions->getIdentityKey());

                $errorCount = (int)$tableUserEntity->getErrorcount();

                if ($errorCount < $passwordErrorCount) {
                    $tableUserEntity->setErrorcount(++$errorCount);
                    $userTable->save($tableUserEntity);
                }
            }

        }
    }

    public function setLastLoginInfo(EventInterface $e)
    {

        $userEntity = $e->getUserEntity();


        $controller = $e->getTarget();

        $ip = $controller->getRequest()->getServer()->get('REMOTE_ADDR');
        $userEntity->setLastlogindate(time());
        $userEntity->setLastloginip($ip);

        $userTable = $controller->getServiceLocator()->get('KpUser\Model\UserTable');

        $userTable->save($userEntity);
    }

    public function setIdentityKey(EventInterface $e)
    {
        $userEntity = $e->getUserEntity();
        $userModuleOptions = $e->getUserModuleOptions();

        // 检查用户使用的是email还是username登录
        $identityKey = $userModuleOptions->getIdentityKey();

        if ($identityKey === '*') {

            $emailAddress = new EmailAddress();
            if ($emailAddress->isValid($userEntity->getUsername())) {
                $identityKey = 'email';
            } else {
                $identityKey = 'username';
            }
            $userModuleOptions->setIdentityKey($identityKey);
        }
    }


    /**
     * @param EventInterface $e
     */
    public function checkStatus(EventInterface $e)
    {
        $userEntity = $e->getUserEntity();

        $userModuleOptions = $e->getUserModuleOptions();

        $identityKey = $userModuleOptions->getIdentityKey();

        $userTable = $e->getTarget()->getServiceLocator()->get('KpUser\Model\UserTable');

        $tableUserEntity = $userTable->getOneByField($userEntity->getUsername(), $identityKey);

        if ($tableUserEntity && (int)$tableUserEntity->getStatus() === (int)UserModel::BAN_LOGIN_STATUS) {
            $e->getForm()->get('username')->setMessages(array(UserModel::BAN_LOGIN_MESSAGES));
            return false;
        }
    }
}