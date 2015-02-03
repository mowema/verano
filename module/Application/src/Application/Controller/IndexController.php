<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;

class IndexController extends AbstractActionController {

    protected $container;
    protected $view;
    protected $em;

    const ROUTE_CHANGEPASSWD = 'zfcuser/changepassword';
    const ROUTE_LOGIN = 'zfcuser/login';
    const ROUTE_REGISTER = 'zfcuser/register';
    const ROUTE_CHANGEEMAIL = 'zfcuser/changeemail';
    const CONTROLLER_NAME = 'zfcuser';

    public function onDispatch(\Zend\Mvc\MvcEvent $e) {
/*
        if (!$this->zfcUserAuthentication()->hasIdentity()) {
            return $this->redirect()->toRoute(static::ROUTE_LOGIN);
        }*/

        //$ruta = $this->zfcUserAuthentication()->getIdentity()->getRuta();
        //if ($ruta) return $this->redirect()->toRoute($ruta);

        return parent::onDispatch($e);
    }

    public function getRenderer() {
        $this->renderer = $this->getServiceLocator()->get('Zend\View\Renderer\PhpRenderer');

        return $this->renderer;
    }

    public function setEntityManager(EntityManager $em) {
        $this->em = $em;
    }

    public function getEntityManager() {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    public function __construct() {

        $this->grupoContainer = new Container('grupo');
        $this->view = new ViewModel();
        //echo $this->grupoContainer->grupo;
    }

    public function indexAction() {
        
        $entityManager = $this->getEntityManager();
	$noticias = $entityManager->getRepository('Admin\Entity\Noticias')->getActivas(9);
        $imgnrand = rand(1, 5);
        $this->view->setVariable('imgnrand', $imgnrand);
        $this->view->setVariable('noticias', $noticias);
        return $this->view;
    }
    
    

}
