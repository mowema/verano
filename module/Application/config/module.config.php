<?php

namespace Application;

use Application\View\Helper\Requesthelper;

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
            'ajx' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/ajax[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Ajax',
                        'action' => 'index',
                    ),
                ),
            ),
            'admin' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Admin',
                        'action' => 'index',
                    ),
                ),
            ),
            'usuarios' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/usuarios[/:action][/:id][/grupo/:grupo][/controlador/:controlador][/informe/:informe][/apapelera/:apapelera][/page/:page]',
                    'constraints' => array(
                        'action' => '(?!\bpage\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        'page' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Usuarios',
                        'action' => 'index',
                    ),
                ),
            ),
            'roles' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/roles[/:action][/:id][/apapelera/:apapelera][/page/:page]',
                    'constraints' => array(
                        'action' => '(?!\bpage\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '[0-9]+',
                        'page' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Roles',
                        'action' => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        //
        //
        	
        ),
    ),
    'view_helpers' => array(
        'factories' => array(
            'Requesthelper' => function($sm) {
                $helper = new Requesthelper();
                $request = $sm->getServiceLocator()->get('Request');
                $helper->setRequest($request);
                return $helper;
            }
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
        ),
        'invokables' => array(
            /* ZendDeveloperTools Configuration */
            'Application\ConfigCollector'   => 'Application\Collector\ConfigCollector',
            'Zend\Authentication\AuthenticationService' => 'Zend\Authentication\AuthenticationService',
        ),
    ),
    'translator' => array(
        'locale' => 'es',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Admin' => 'Application\Controller\AdminController',
            'Application\Controller\Ajax' => 'Application\Controller\AjaxController',
            'Application\Controller\crud' => 'Application\Controller\CRUDController',
            'Application\Controller\Usuarios' => 'Application\Controller\UsuariosController',
            'Application\Controller\Roles' => 'Application\Controller\RolesController',
            'zfcuser' => 'ZfcUser\Controller\UserController',
        //'user'				=> 'Application\Controller\UserController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/application' => __DIR__ . '/../view/layout/layout.phtml',
            'layout/blank' => __DIR__ . '/../view/layout/blank.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
            'menu' => __DIR__ . '/../view/layout/menu.phtml',
            
            'block/head' => __DIR__ . '/../view/layout/inc_head.phtml',
            'block/down' => __DIR__ . '/../view/layout/inc_downScript.phtml',
        ),
        'template_path_stack' => array(
            'module' => __DIR__ . '/../view',
            'partial' => __DIR__ . '/../view/partial',
            'pager' => __DIR__ . '/../view/application',
            'StaticPages' => __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    'module_layouts' => array(
            'Application' => 'layout/application',
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
                    'Application\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        ),
    ),
    'zfcuser' => array(
        // telling ZfcUser to use our own class
        'user_entity_class' => 'Application\Entity\User',
        // telling ZfcUserDoctrineORM to skip the entities it defines
        'enable_default_entities' => false,
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
                'Autenticado' => array(),
                'Gestor' => array('children' => array(
                        'Administrador' => array(),
                    )),
            ),
        ),
        'resource_providers' => array(
            'BjyAuthorize\Provider\Resource\Config' => array(
                'usuarios' => array(),
                'roles' => array(),
                'organismo' => array(),
                'crud' => array(),
                'crudplus' => array(),
                'reporte' => array(),
                'noticias' => array(),
            ),
        ),
        'rule_providers' => array(
            'BjyAuthorize\Provider\Rule\Config' => array(
                'allow' => array(
                    // allow guests and users (and admins, through inheritance)
                    // the "wear" privilege on the resource "pants"
                    array(array('Administrador'), 'noticias', array('index', 'crear', 'editar', 'apapelera')),
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
                array('controller' => 'Application\Controller\Index', 'roles' => array('Invitado', 'Autenticado')),
                array('controller' => 'Application\Controller\Roles', 'roles' => array()),
                array('controller' => 'Application\Controller\Usuarios', 'roles' => array()),
                array('controller' => 'zfcuser', 'roles' => array('Invitado', 'Autenticado')),
            // You can also specify an array of actions or an array of controllers (or both)
            // allow "guest" and "admin" to access actions "list" and "manage" on these "index",
            // "static" and "console" controllers
            ),
       
        ),
    ),
       
);
