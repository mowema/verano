<?php 
namespace Application\Controller;

use Zend\Debug\Debug;

use Application\Entity\UserGrupoTrabajoReference;

use Zend\Session\Container;
use Zend\Crypt\Password\Bcrypt;
use Application\Entity\User;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel,
Application\Form\UsuarioForm;
use Doctrine\ORM\EntityManager;
 
class UserController extends AbstractActionController
{
    const ROUTE_CHANGEPASSWD = 'zfcuser/changepassword';
    const ROUTE_LOGIN        = 'zfcuser/login';
    const ROUTE_REGISTER     = 'zfcuser/register';
    const ROUTE_CHANGEEMAIL  = 'zfcuser/changeemail';
    
    const CONTROLLER_NAME    = 'zfcuser';
    /**
	* @var Doctrine\ORM\EntityManager
	*/
	protected $em;
	protected $grupotrabajo;
	protected $renderer;
	protected $view;
	
	public function __construct(){
		$this->view = new ViewModel();
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
	    $this->getRenderer()->headLink()->appendStylesheet('/fancybox/jquery.fancybox.css');
		
		$entityManager = $this->getEntityManager();
		
		$matches = $this->getEvent()->getRouteMatch();
		$page      = $matches->getParam('pag', 1);
		
		$usuarios = $entityManager->getRepository('Application\Entity\User')->getUsuariosActivos(1);
		$this->view->setVariable('usuarios', $usuarios);
		
		$paginator = new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\ArrayAdapter($usuarios));
		
		$paginator->setCurrentPageNumber($page);
		$paginator->setItemCountPerPage(20);
		
		$this->view->setVariable('lang', $matches->getParam('lang','es'));
		$this->view->setVariable('usuarios', $paginator);
			
		return $this->view;
	}
	
	public function crearAction()
	{
	
		$request = $this->getRequest();
		$entityManager = $this->getEntityManager();
		$bcrypt = new Bcrypt();
	
		$usuario = new User();
	
		if ($request->isPost()) {

                    $request = $this->getRequest();

                    $username	 = $request->getPost()->usuario['username'];
                    $password	 = $request->getPost()->usuario['password'];
                    $email		 = $request->getPost()->usuario['email'];
                    $displayName = $request->getPost()->usuario['displayName'];
                    $arrRoles		 = $request->getPost()->roleid;
                    $arrGrupos		 = $request->getPost()->grupoid;

                    foreach ($arrRoles as $roleId):

                    $roles[] = $entityManager->find('Application\Entity\Role', $roleId);

                    endforeach;

                    $usuario->addRoles($roles);

                    $usuario->setUsername($username);
                    $usuario->setPassword($bcrypt->create($password));
                    $usuario->setEmail($email);
                    $usuario->setDisplayName($displayName);
                    $usuario->setState(1);

                    $entityManager->persist($usuario);

                    $entityManager->flush();

                    $rUserGrupoTrabajo = new UserGrupoTrabajoReference();

                    $usuarioid = $usuario->getId();

                    $usuario = $entityManager->find('Application\Entity\User', $usuario->getId());

                    foreach ($arrGrupos as $grupoId):

                    $grupoId = $entityManager->find('Application\Entity\GrupoTrabajo', $grupoId);

                    $rUserGrupoTrabajo->setUsuario($usuario);

                    $rUserGrupoTrabajo->setGrupo($grupoId);

                    endforeach;

                    $entityManager->persist($rUserGrupoTrabajo);

                    $entityManager->flush();

                    $this->flashMessenger()->addMessage('success_El usuario se creó con Éxito!');

                    return $this->redirect()->toRoute('usuarios');

		}
	
		$form = new UsuarioForm($entityManager);
	
		$form->get('submit')->setAttribute('value', 'Guardar');
	
		$this->view->setVariable('noticias', $usuario);
		$this->view->setVariable('form', $form);
		return $this->view;
	}
	
        
	public function editarAction()
	{

		$request = $this->getRequest();
		$entityManager = $this->getEntityManager();
		$request = $this->getRequest();
		$bcrypt = new Bcrypt();
		
		$id = (int)$this->getEvent()->getRouteMatch()->getParam('id');
		
		if (!$id) {
			return $this->redirect()->toRoute('application', array('action'=>'index'));
		}
		
		$usuario = $this->getEntityManager()->find('Application\Entity\User', $id);
				
		if ($request->isPost()) {

				$username = $request->getPost()->usuario['username'];
				$password = $request->getPost()->usuario['password'];
				$email = $request->getPost()->usuario['email'];
				$displayName = $request->getPost()->usuario['displayName'];
				$arrRoles		 = $request->getPost()->roleid;

				foreach ($arrRoles as $roleId):
				
					$roles[] = $entityManager->find('Application\Entity\Role', $roleId);
													
				endforeach;
				
				$usuario->addRoles($roles);

				$usuario->setUsername($username);
				$usuario->setPassword($bcrypt->create($password));
				$usuario->setEmail($email);
				$usuario->setDisplayName($displayName);
				$usuario->setState(1);
				
				$this->getEntityManager()->persist($usuario);
								
				$this->getEntityManager()->flush();
				
				$this->flashMessenger()->addMessage('success_El usuario se modificó con Éxito!');
				
				return $this->redirect()->toRoute('usuarios');
			
		}
		
		$form = new UsuarioForm($entityManager, $id);
		
		$form->bind($usuario);
		
		$this->view->setVariable('id', $id);
		$this->view->setVariable('form', $form);
		
		return $this->view;
	}
     
        
	public function apapeleraAction()
	{
	
		$id = (int) $this->params('id', null);
			
	    if (null === $id) {

	    	return $this->redirect()->toRoute('usuarios');

	    }
		    	
			$usuario = $this->getEntityManager()->find('Application\Entity\User', $id);
			
			$usuario->setState(-1);
			
			$this->getEntityManager()->persist($usuario);

			$this->getEntityManager()->flush();
			
			$this->flashMessenger()->addMessage('success_El usuario se envió a papelera!');
			
			return $this->redirect()->toRoute('usuarios');
			
			return $this->view;
	
	}
     
    
	public function activargrupoAction()
	{
	
		$entityManager = $this->getEntityManager();
		
		$matches = $this->getEvent()->getRouteMatch();
	
		$idGrupo = $matches->getParam('grupo');
		$controlador = (string)$matches->getParam('controlador');
		$grupotrabajo = $this->getEntityManager()->find('Application\Entity\GrupoTrabajo', $idGrupo);
				
		$container = new Container('grupo');
		$container->grupo = $idGrupo;
		$container->grupoNombre = $grupotrabajo->getNombre();
	
		return $this->redirect()->toRoute($controlador);
	
	}
	

	public function informeAction(){
	
		$entityManager = $this->getEntityManager();
		$idusuario = (int)$this->getEvent()->getRouteMatch()->getParam('id');
		
		if (!$idusuario) {
			echo ('nada para mostrar');
			return $this->response;
		}
	
		$usuario = $this->getEntityManager()->find('Application\Entity\User', $idusuario);

		$noticias = $entityManager->getRepository('Application\Entity\Noticia')->getNoticiasUser(1, $this->grupotrabajo, $idusuario ,1 );
	
		$this->view->setVariable('usuario', $usuario);
		$this->view->setVariable('noticias', $noticias);
	
		$this->layout('layout/blank.phtml');
	
		return $this->view;
	
	}
		
	
}