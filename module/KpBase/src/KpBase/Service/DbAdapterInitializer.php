<?php
/**
 * Kittencup (http://www.kittencup.com/)
 * @date 2014 14-4-27 上午11:18
 */

namespace KpBase\Service;

use Zend\Db\Adapter\AdapterAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\InitializerInterface;

class DbAdapterInitializer implements InitializerInterface{

    public function initialize($instance, ServiceLocatorInterface $serviceLocator)
    {
        if($instance instanceof AdapterAwareInterface){

            $instance->setDbAdapter($serviceLocator->get('Zend\Db\Adapter\Adapter'));
        }
    }

}