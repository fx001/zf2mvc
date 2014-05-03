<?php
/**
 * Kittencup (http://www.kittencup.com/)
 * @date 2014 14-4-27 上午11:06
 */

namespace KpBase;

use Zend\Db\TableGateway\Feature\GlobalAdapterFeature;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\Mvc\MvcEvent;
use Zend\Validator\AbstractValidator;

class Module implements AutoloaderProviderInterface,
    ServiceProviderInterface
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

    public function onBootstrap(MvcEvent $mvcEvent)
    {
        $target = $mvcEvent->getTarget();
        $eventManager = $target->getEventManager();

        $eventManager->attach(MvcEvent::EVENT_DISPATCH, function (MvcEvent $e) {
            $serviceManager = $e->getApplication()->getServiceManager();
            $adapater = $serviceManager->get('Zend\Db\Adapter\Adapter');
            GlobalAdapterFeature::setStaticAdapter($adapater);
        }, 2);

        $translator = $target->getServiceManager()->get('MvcTranslator');
        $translator->addTranslationFile('phpArray', './vendor/zendframework/zendframework/resources/languages/zh/Zend_Validate.php', 'default', 'zh_CN');
        AbstractValidator::setDefaultTranslator($translator);

    }

    public function getServiceConfig()
    {
        return array(
            'initializers' => array(
                'KpBase\Service\DbAdapterInitializer'
            )
        );
    }
}