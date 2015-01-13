<?php
$env = (getenv('APPLICATION_ENV') ?: 'production');

$modules = array(
        'ZfcBase',
        'DoctrineModule',
        'DoctrineORMModule',
        'ZfcUser',
        'BjyAuthorize',
    	'Application',
       	'ZfcUserDoctrineORM',
    	'ZfcTwitterBootstrap',
    	'Admin',
    //	'GoogleMaps',
     // 'GoalioMailService',
     // 'GoalioForgotPassword'
   );

if (($env == 'development') || ($env == 'devlocal')) {
    $modules[] = 'ZendDeveloperTools';
}

return array(
    'modules' => $modules,
    'module_listener_options' => array(
        'config_glob_paths'    => array(
            'config/autoload/{,*.}{global,local}.php',
         //   'config/autoload/{,*.}' . (getenv('APPLICATION_ENV') ?: 'production') . '.php',
        ),
        'module_paths' => array(
            './module',
            './vendor',
        ),
    ),
);
