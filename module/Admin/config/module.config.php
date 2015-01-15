<?php
namespace Admin;

use Application\View\Helper\Requesthelper;

return array(
    
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                   /* 'defaults' => array(
                        'controller' => 'Admin\Controller\Index',
                        'action'     => 'index',
                    ),*/
                ),
            ),
            'a' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/a[/:action][/:id][/apapelera/:apapelera]',
                    'constraints' => array(
                        'action' => '(?!\bpag\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        'pag' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
        // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /Admin/:controller/:action
            
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity'),
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Admin\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/admin'           => __DIR__ . '/../view/layout/ly_admin.phtml',
        ),
        'template_path_stack' => array(
            'module' => __DIR__ . '/../view',
        	'partial_admin' => __DIR__ . '/../view/admin/partial',
        	'pager' => __DIR__ . '/../view/admin'
        	
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Index' => 'Admin\Controller\IndexController',
        ),
    ),
    'module_layouts' => array(
			'Admin' => 'layout/admin',
			'ZfcUser' => 'layout/admin',
    ),
        

);
