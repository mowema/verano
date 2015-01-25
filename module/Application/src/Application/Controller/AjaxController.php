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

class AjaxController extends AbstractActionController {

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
        
        $request = $this->getRequest();
        $data = $request->getPost();
        
        if ($data['id']==0){
            $entityManager = $this->getEntityManager();
            $noticias = $entityManager->getRepository('Admin\Entity\Noticias')->getActivas(1,30);
            $this->view->setVariable('noticias', $noticias);
        }
        
        $this->view->setTerminal(true);
        
        $this->view->setVariable('data', $data);
        return $this->view;
    }
    public function actividadesAction() {
        
        $request = $this->getRequest();
        $data = $request->getPost();
        
        
        $this->view->setTerminal(true);
        
        $this->view->setVariable('data', $data);
        return $this->view;
    }
    public function planoAction() {
        
        $request = $this->getRequest();
        $data = $request->getPost();
        //echo $data['id'];
        
        $this->view->setTerminal(true);
        
        $this->view->setVariable('data', $data);
        return $this->view;
    }

        
    public function noticiaAction(){
        $request = $this->getRequest();
        $data = $request->getPost();
        $entityManager = $this->getEntityManager();
        $noticia = $entityManager->getRepository('Admin\Entity\Noticias')->find($data['idnoticia']);
        
         $this->view->setTerminal(true);
       
        $this->view->setVariable('data', $noticia);
        return $this->view;
    }
}
