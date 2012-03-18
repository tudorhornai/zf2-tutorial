<?php
return array(
    'di' => array(
        'instance' => array( 
            'alias' => array(
                'album' => 'Admin\Controller\AlbumController',
                'admin' => 'Admin\Controller\AdminController',
                'test' => 'Admin\Controller\TestController',
            ),
            'Admin\Controller\AlbumController' => array(
                'parameters' => array(
                    'albumTable' => 'Album\Model\AlbumTable',
                ),
            ),
            'Album\Model\AlbumTable' => array(
                'parameters' => array(
                    'adapter' => 'Zend\Db\Adapter\Adapter',
                )
            ),
            'Zend\Db\Adapter\Adapter' => array(
                'parameters' => array(
                    'driver' => array(
                        'driver'    => 'Pdo',
                        'dsn'       => 'mysql:dbname=zf2tutorial;hostname=localhost',
                        'username'  => 'root',
                        'password'  => '',
                    ),
                )
            ),
            'Zend\View\Resolver\TemplatePathStack' => array(
                'parameters' => array(
                    'paths' => array(
                        'admin' => __DIR__ . '/../view',
                    ),
                ),
            ),
        ),
    ),
);