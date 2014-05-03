<?php


return array(
    'router' => array(
        'routes' => array(
            'KpUser-reg'=>array(
                'type'=>'literal',
                'options'=>array(
                    'route'=>'/reg.html',
                    'defaults' => array(
                        'controller' => 'KpUser\Controller\User',
                        'action'     => 'reg',
                    ),
                )
            ),
            'KpUser-login'=>array(
                'type'=>'literal',
                'options'=>array(
                    'route'=>'/login.html',
                    'defaults' => array(
                        'controller' => 'KpUser\Controller\User',
                        'action'     => 'login',
                    ),
                )
            )
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'template_map' => array(
            'KpUser/Layout'           => __DIR__ . '/../view/layout/layout.phtml',
        )
    ),
    'service_manager'=>array(
        'invokables'=>array(
            'KpUser\Model\UserTable'=>'KpUser\Model\UserTable'
        ),

    )
);
