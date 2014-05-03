<?php
namespace KpUser\Listener;

use KpUser\Event\UserRegEvent;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;

class UserRegListener implements ListenerAggregateInterface{
    public function attach(EventManagerInterface $events){
        $events->getSharedManager()->attach('*',UserRegEvent::USER_REG_PRE,array($this,'setCheckUsername'));
        $events->getSharedManager()->attach('*',UserRegEvent::USER_REG_PRE,array($this,'setRegdate'));
    }

    public function detach(EventManagerInterface $events){

    }

    //过滤敏感词
    public function setCheckUsername($e){
        $userEntity=$e->getParam('userEntity');
        if($userEntity->getUsername()==='1234567'){
            $e->stopPropagation(true);
            return false;
        }
    }

    public function setRegdate($e){
        $userEntity=$e->getParam('userEntity');
        $userEntity->setRegdate(time());
    }
}