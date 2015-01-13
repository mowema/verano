<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin;


use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Authentication\AuthenticationService;

class Module implements AutoloaderProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
        	        		
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
		    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
                ),
            ),
        );
    }

    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

	 public function onBootstrap($e)
    {
    $e->getApplication()->getServiceManager()->get('translator');
    $eventManager        = $e->getApplication()->getEventManager();
    $moduleRouteListener = new ModuleRouteListener();
    $moduleRouteListener->attach($eventManager);


    $e->getApplication()->getEventManager()->getSharedManager()
    ->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function($e) {
        $controller      = $e->getTarget();
        $controllerClass = get_class($controller);
        $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
        $config          = $e->getApplication()->getServiceManager()->get('config');
        if (isset($config['module_layouts'][$moduleNamespace])) {
            $controller->layout($config['module_layouts'][$moduleNamespace]);
          //  echo $config['module_layouts'][$moduleNamespace];
        }
    }, 100);

    }
    
    
}
