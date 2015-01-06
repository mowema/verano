<?php 
namespace Application\Controller;
 
use Zend\Session\Container;

use Application\Entity\Role;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\RolForm;
use Doctrine\ORM\EntityManager;

class RolesController extends AbstractActionController
{
    /**
	* @var Doctrine\ORM\EntityManager
	*/

	const ROUTE_CHANGEPASSWD = 'zfcuser/changepassword';
	const ROUTE_LOGIN        = 'zfcuser/login';
	const ROUTE_REGISTER     = 'zfcuser/register';
	const ROUTE_CHANGEEMAIL  = 'zfcuser/changeemail';
	const ROUTE_LISTADO  =	   'zfcuser/index';
	
	protected $em;
	protected $grupotrabajo;
	protected $renderer;
	protected $view;
	
	
	public function onDispatch(\Zend\Mvc\MvcEvent $e) {
		if (!$this->zfcUserAuthentication()->hasIdentity()) {
			return $this->redirect()->toRoute(static::ROUTE_LOGIN);
		}
		if (!$this->isAllowed('roles', 'index','crear','editar','apapelera')) {
		
			throw new \BjyAuthorize\Exception\UnAuthorizedException('a ingresar a esta accion');
		}
		
		return parent::onDispatch( $e );
				
	}
	
	public function __construct(){
		$this->view = new ViewModel();
		
		$container = new Container('grupo');
		$this->grupotrabajo = $container->grupo;
		
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
			$this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
	}
		return $this->em;
	}
	
	
	public function indexAction()
	{
	
	    $this->getRenderer()->headScript()->appendFile('/js/confirm-deletion.js', 'text/javascript');

		$entityManager = $this->getEntityManager();

		$matches = $this->getEvent()->getRouteMatch();
		$page      = $matches->getParam('pag', 1);
		
		$roles = $entityManager->getRepository('Application\Entity\Role')->findAll();
		
		
		$paginator = new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\ArrayAdapter($roles));
		
		$paginator->setCurrentPageNumber($page);
		$paginator->setItemCountPerPage(20);
		
		$this->view->setVariable('roles', $roles);
		$this->view->setVariable('lang', $matches->getParam('lang','es'));
		$this->view->setVariable('roles', $paginator);
				
		return $this->view;
	}
     
	public function crearAction()
	{
		$request = $this->getRequest();
		$entityManager = $this->getEntityManager();

		$form = new RolForm();
		
		$rol = new Role();
		
		if ($request->isPost()) {
		
			$request = $this->getRequest();
	
			$roleId = $request->getPost()->rol['roleId'];
				
			$rol->setRoleId($roleId);
			
			$entityManager->persist($rol);
															
				$entityManager->flush();

				$this->flashMessenger()->addMessage('success_El rol se creó con éxito!');
				
				return $this->redirect()->toRoute('roles');
			
		}
	 
		$this->view->setVariable('noticias', $rol);
		$this->view->setVariable('form', $form);
		return $this->view;
	}
     
	public function editarAction()
	{
	   
		$request = $this->getRequest();
		$entityManager = $this->getEntityManager();
		$id = (int)$this->getEvent()->getRouteMatch()->getParam('id');
		
		if (!$id) {
			return $this->redirect()->toRoute('application', array('action'=>'index'));
		}
		
		$rol = $this->getEntityManager()->find('Application\Entity\Role', $id);
		
		$form = new RolForm();
		
		$form->bind($rol);
		
		$request = $this->getRequest();
		
		if ($request->isPost()) {

			$roleId = $request->getPost()->rol['roleId'];
									
			$rol->setRoleId($roleId);
		
			$this->getEntityManager()->persist($rol);
				
			$this->flashMessenger()->addMessage('success_El rol se modificó con éxito!');
			
			$this->getEntityManager()->flush();
				
			// Redirect to list of albums
			return $this->redirect()->toRoute('roles');
			
		}
	
		$this->view->setVariable('id', $id);
		$this->view->setVariable('form', $form);
		return $this->view;
	}
    
/*	public function apapeleraAction()
	{
	    if (!$this->zfcUserAuthentication()->hasIdentity()) {
	    	return $this->redirect()->toRoute(static::ROUTE_LOGIN);
	    }
	    $view = new ViewModel();
	    
		$id = (int) $this->params('id', null);

		
	    if (null === $id) {
	      return $this->redirect()->toRoute('roles');
	    }

	    	$rol = $this->getEntityManager()->find('Application\Entity\Role', $id);
	    	
	    	$rol->setState(-1);
	    		
	    	$this->getEntityManager()->persist($rol);
	    		
	    	$this->getEntityManager()->flush();

	    	return $this->redirect()->toRoute('roles');
	    
	    return $view;


	}
     
*/    
    
}