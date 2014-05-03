<?php
namespace Album;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements AutoloaderProviderInterface,ConfigProviderInterface{

    // Zend\ModuleManager\Listener\AutoloaderListener 通过该方法为该模板配置自动加载
    public function getAutoloaderConfig(){
        return array(
            'Zend\Loader\StandardAutoloader'=>array(
                'namespaces'=>array(
                    __NAMESPACE__=>__DIR__.'/src/'.__NAMESPACE__
                )
            )
        );
    }

    // Zend\ModuleManager\Listener\ConfigListener 通过该方法获取当前模块的配置内容
    public function getConfig(){
        return include __DIR__.'/config/module.config.php';
    }
}
?>