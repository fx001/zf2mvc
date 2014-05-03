<?php
namespace Album;

use Album\Model\Album;
use Album\Model\AlbumTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\ServiceLocatorInterface;

//当前模块的配置
return array(
    // controllerManager 控制器管理器
    'controllers'=>array(
        'invokables'=>array(
            'Album\Controller\Album'=>'Album\Controller\AlbumController'
        )
    ),
    'router'=>array(
        'routes'=>array(
            'album'=>array(
                // 路由类型 Zend\Mvc\Router\Http\Segment
                'type'=>'segment',
                'options'=>array(
                    // [] 可选参数，:action 表示可动态替换参数
                    'route'=>'/album[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    // 默认配置
                    'defaults' => array(
                        // 这个是服务名
                        'controller' => 'Album\Controller\Album',
                        'action'     => 'index',
                    ),
                )
            )
        )
    ),
    'view_manager'=>array(
        'template_path_stack'=>array(
            __DIR__.'/../view'
        ),
        'doctype' => 'HTML5',
        'template_map' => array(
            'album/layout'           => __DIR__ . '/../view/layout/layout.phtml',

        )
    ),
    'service_manager'=>array(
        'factories'=>array(
            'Zend\Db\Adapter\Adapter'=> 'Zend\Db\Adapter\AdapterServiceFactory',
            'Album\Model\AlbumTable' =>  function(ServiceLocatorInterface $serviceManager) {

                    $tableGateway = $serviceManager->get('AlbumTableGateway');

                    $table = new AlbumTable($tableGateway);

                    return $table;
                },
            'AlbumTableGateway' => function (ServiceLocatorInterface $serviceManager) {

                    // 获取数据库适配
                    $dbAdapter = $serviceManager->get('Zend\Db\Adapter\Adapter');

                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Album());
                    return new TableGateway('album', $dbAdapter, null, $resultSetPrototype);
                },
        )
    )
);