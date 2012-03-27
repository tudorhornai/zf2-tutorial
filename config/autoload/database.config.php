<?php
// ./config/autoload/database.config.php
return array(
    'di' => array(
        'instance' => array(
            'alias' => array(
                'masterdb' => 'PDO',
            ),
            'masterdb' => array(
                'parameters' => array(
                    'dsn'            => 'mysql:dbname=zf2tutorial;host=localhost',
                    'username'       => 'root',
                    'passwd'         => '',
                    'driver_options' => array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''),
                ),
            ),
        ),
    ),
);