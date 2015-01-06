<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Authentication\AuthenticationService;

class Module implements AutoloaderProviderInterface {

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/', __NAMESPACE__),
                ),
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getViewHelperConfig() {
        return array(
            'factories' => array(
                'Layouthelper' => function($sm) {
                    $sm = $sm->getServiceLocator();
                    $helper = new View\Helper\Layouthelper;
                    return $helper;
                }
            )
        );
    }

    public function onBootstrap($e) {
        $translator = new \Zend\Mvc\I18n\Translator();
        $translator->addTranslationFile(
                'phpArray', __DIR__ . '/language/Zend_Validate_es.php', 'default', 'es'
        );

        $translator->setLocale('en');
        \Zend\Validator\AbstractValidator::setDefaultTranslator($translator, 'default');

        $sm = $e->getApplication()->getServiceManager();

        // Add ACL information to the Navigation view helper
        $authorize = $sm->get('BjyAuthorizeServiceAuthorize');
        $acl = $authorize->getAcl();
        $role = $authorize->getIdentity();
        \Zend\View\Helper\Navigation::setDefaultAcl($acl);
        \Zend\View\Helper\Navigation::setDefaultRole($role);



        $e->getApplication()->getEventManager()->getSharedManager()
              ->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function($e) {
                    // You may not need to do this if you're doing it elsewhere in your
                    // application
                    $eventManager = $e->getApplication()->getEventManager();
                    $moduleRouteListener = new ModuleRouteListener();
                    $moduleRouteListener->attach($eventManager);
                    $controller = $e->getTarget();
                    $controllerClass = get_class($controller);
                    $application = $e->getParam('application');
                    $viewModel = $application->getMvcEvent()->getViewModel();

                    $routeMatch = $e->getRouteMatch();
                    //Debug::dump($routeMatch);die();
                    $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));

                    $config = $e->getApplication()->getServiceManager()->get('config');
                    // Parsing URI to get controller name
                    $viewModel->controllerName = strtolower($routeMatch->getMatchedRouteName('controller', 'not-found')); // get the matchedRouteName

                    $viewModel->actionName = strtolower($routeMatch->getParam('action', 'not-found')); // get the action name

                    if (substr_count($viewModel->controllerName, '/')) {
                        $viewModel->controllerName = substr($viewModel->controllerName, 0, strpos($viewModel->controllerName, '/'));
                    }
                    if (isset($config['module_layouts'][$moduleNamespace])) {
                        $controller->layout($config['module_layouts'][$moduleNamespace]);
                    }
                }, 100);
    }

}
