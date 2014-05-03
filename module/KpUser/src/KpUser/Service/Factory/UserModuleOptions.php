<?php
namespace KpUser\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use KpUser\Options\UserModuleOptions as UserOptions;

class UserModuleOptions implements FactoryInterface{
    public function createService(ServiceLocatorInterface $serviceLocator){
        $config=$serviceLocator->get('config');
        return new UserOptions(isset($config['kp_user'])?$config['kp_user']:array());
    }
}