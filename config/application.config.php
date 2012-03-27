<?php
return array(
    'modules' => array(
        'Application', 
		'Admin',
        'Album',	
		'ZfcBase',
		'ZfcUser'
    ),
    'module_listener_options' => array( 
        'config_cache_enabled' => false,
        'cache_dir'            => 'data/cache',
        'module_paths' => array(
            './module',
            './vendor',
        ),
    ),
);
