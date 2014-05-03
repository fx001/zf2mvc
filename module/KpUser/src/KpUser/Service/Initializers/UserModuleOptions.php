<?php
/**
 * Created by PhpStorm.
 * User: onlyit
 * Date: 14-5-2
 * Time: 下午1:07
 */

namespace KpUser\Service\Initializers;


use KpUser\Options\UserModuleOptionAwareInterface;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserModuleOptions implements InitializerInterface
{

    public function initialize($instance, ServiceLocatorInterface $serviceLocator)
    {

        if ($instance instanceof UserModuleOptionAwareInterface) {

            if ($serviceLocator instanceof AbstractPluginManager) {
                $serviceLocator = $serviceLocator->getServiceLocator();
            }
            $instance->setUserModuleOptions($serviceLocator->get('KpUser\UserModuleOptions'));
        }
    }
} 