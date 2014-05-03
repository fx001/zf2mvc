<?php
/**
 * Kittencup (http://www.kittencup.com/)
 * @date 2014 14-4-26 上午11:44
 */

namespace KpUser;

use KpUser\Listener\UserLoginListener;
use KpUser\Listener\UserRegListener;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\DependencyIndicatorInterface;
use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\ModuleManagerInterface;
use Zend\Mvc\MvcEvent;


class Module implements ConfigProviderInterface,
    AutoloaderProviderInterface,
    ControllerProviderInterface,
    DependencyIndicatorInterface,
    ServiceProviderInterface,
    InitProviderInterface,
    BootstrapListenerInterface
{

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'invokables' => array(
                'KpUser\Model\UserTable' => 'KpUser\Model\UserTable'
            ),
            'factories' => array(
                'KpUser\UserModuleOptions' => 'KpUser\Service\Factory\UserModuleOptions'
            ),

        );
    }

    public function getModuleDependencies()
    {
        return array(
            'KpBase'
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getControllerConfig()
    {
        return array(
            'invokables' => array(
                'KpUser\Controller\User' => 'KpUser\Controller\UserController'
            ),
            'initializers' => array(
                'KpUser\Service\Initializers\UserModuleOptions'
            )
        );
    }

    public function init(ModuleManagerInterface $moduleManager)
    {

    }

    public function onBootstrap(EventInterface $mvcEvent)
    {
        $target = $mvcEvent->getTarget();
        $eventManager = $target->getEventManager();
        $eventManager->getSharedManager()->attach(__NAMESPACE__, MvcEvent::EVENT_DISPATCH, function (MvcEvent $e) {
            $controller = $e->getTarget();
            $controller->layout('KpUser/Layout');
        }, 2);


        $eventManager->attach(new UserRegListener());
        $eventManager->attach(new UserLoginListener());
    }

}