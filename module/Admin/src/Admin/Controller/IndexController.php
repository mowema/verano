<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;


use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\EntityManager;
use Application\Form\NoticiasForm;

class IndexController extends AbstractActionController {

	const ROUTE_CHANGEPASSWD = 'zfcuser/changepassword';
	const ROUTE_LOGIN        = 'zfcuser/login';
	const ROUTE_REGISTER     = 'zfcuser/register';
	const ROUTE_CHANGEEMAIL  = 'zfcuser/changeemail';
	
	const CONTROLLER_NAME    = 'zfcuser';
	
	protected $em;
	protected $renderer;
	protected $view;

	
	public function __construct(){
	
		$this->view = new ViewModel();
	
	}
	
	public function onDispatch(\Zend\Mvc\MvcEvent $e) {
		
		if (!$this->zfcUserAuthentication()->hasIdentity()) {
			return $this->redirect()->toRoute(static::ROUTE_LOGIN);
		}
	
		
		/*if (!$this->isAllowed('administrar')) {
		
			throw new \BjyAuthorize\Exception\UnAuthorizedException('a ingresar a esta accion');
		}*/
		
		
		
		return parent::onDispatch( $e );
	
	}
	
	public function getRenderer()
	{
		$this->renderer = $this->getServiceLocator()->get('Zend\View\Renderer\PhpRenderer');
	
		return $this->renderer;
	}
	
	public function setEntityManager(EntityManager $em)
	{
		$this->em = $em;
	}
	
	public function getEntityManager()
	{
		if (null === $this->em) {
			$this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
		}
		return $this->em;
	}

    public function indexAction()
    {
    	
    	return new ViewModel(array(
    	));
	    	 
	}
    public function noticiaAction()
    {
    	$noticiaForm = new NoticiasForm();
    	return new ViewModel(array(
    	));
	    	 
	}

		    
    
}
