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
    'bjyauthorize' => array(
        'default_role' => 'Invitado',
        // default role for authenticated users (if using the
        // 'BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider' identity provider)
        'authenticated_role' => 'Autenticado',
        // identity provider service name
        //		'identity_provider'     => 'BjyAuthorize\Provider\Identity\ZfcUserZendDb',
        // Using the authentication identity provider, which basically reads the roles from the auth service's identity
        'identity_provider' => 'BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider',
        'role_providers' => array(
            // using an object repository (entity repository) to load all roles into our ACL
            'BjyAuthorize\Provider\Role\ObjectRepositoryProvider' => array(
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'role_entity_class' => 'Application\Entity\Role',
            ),
            'BjyAuthorize\Provider\Role\Config' => array(
                'Invitado' => array(),
                'Autenticado' => array()
            ),
        ),
        'resource_providers' => array(
            'BjyAuthorize\Provider\Resource\Config' => array(
                'admin' => array(),
            ),
        ),
        'rule_providers' => array(
            'BjyAuthorize\Provider\Rule\Config' => array(
                'allow' => array(
                    // allow guests and users (and admins, through inheritance)
                    // the "wear" privilege on the resource "pants"
                    array(array('Administrador'), 'admin', array('administrar')),
                 ),
                // Don't mix allow/deny rules if you are using role inheritance.
                // There are some weird bugs.
                'deny' => array(
                // ...
                ),
            ),
        ),
        'guards' => array(
            /* If this guard is specified here (i.e. it is enabled), it will block
             * access to all controllers and actions unless they are specified here.
             * You may omit the 'action' index to allow access to the entire controller
             */
            'BjyAuthorize\Guard\Controller' => array(
                array('controller' => 'Admin\Controller\Index', 'roles' => array('Administrador')),
                
            // You can also specify an array of actions or an array of controllers (or both)
            // allow "guest" and "admin" to access actions "list" and "manage" on these "index",
            // "static" and "console" controllers
            ),
       
        ),
    ),

);
