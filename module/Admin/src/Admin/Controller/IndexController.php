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
    public function papeleraNoticiaAction()
    {
        $id = (int) $this->params('id', null);

        if (null === $id) {
          return $this->redirect()->toRoute('a',array('action'=>'listar-noticias'));
        }

            $noticia = $this->getEntityManager()->find('Admin\Entity\Noticias', $id);

            $noticia->setState(-1);

            $this->getEntityManager()->persist($noticia);

            $this->getEntityManager()->flush();

            $this->flashMessenger()->addMessage('success_La noticia se envió a papelera!');

            return $this->redirect()->toRoute('a',array('action'=>'listar-noticias'));
            
	    	 
	}
    public function noticiaAction()
    {
        $entityManager = $this->getEntityManager();
        $request = $this->getRequest();
        $id = (int) $this->getEvent()->getRouteMatch()->getParam('id');
        
        $noticiaForm = new NoticiasForm();
        if ($id) {
            $noticia = $this->getEntityManager()->find('Admin\Entity\Noticias', $id);
            if ($noticia){
                $noticiaForm->bind($noticia);
                
            }else{return $this->redirect()->toRoute('a', array('action' => 'noticia'));}
            
            
        } else {$noticia = new \Admin\Entity\Noticias();}


        $this->view->setVariable('form', $noticiaForm);
        



        if ($request->isPost()) {
            $post = $request->getPost()->toArray();
            $noticiaForm->setData($post);
            if ($noticiaForm->isValid()) {
                $validated = $noticiaForm->getData();
                //\Zend\Debug\Debug::dump($validated);
                $title = $validated->getTitle();
                $copete = $validated->getCopete();
                $bajada = $validated->getBajada();
                $imagen_url = $validated->getImagen_url();
                $noticia->setTitle($title);
                $noticia->setCopete($copete);
                $noticia->setBajada($bajada);
                $noticia->setImagen_url($imagen_url);
                $noticia->setCreated_date(new \DateTime('now'));
                $noticia->setModified_date(new \DateTime('now'));
                $noticia->setState(1);
                $entityManager->persist($noticia);
                $entityManager->flush();

                $this->flashMessenger()->addMessage('success_El usuario se creó con éxito!');

                return $this->redirect()->toRoute('a',array('action'=>'listar-noticias'));
                
            } else {
                $messages = $noticiaForm->getMessages();
                \Zend\Debug\Debug::dump($messages);
            }
        }



        return $this->view;
        /*
         * 
         * 
         */


        //$bcrypt = new Bcrypt();



                

/*

                    $username	 = $validated->getUsername();
                    $password	 = $validated->getPassword();
                    $email		 = $validated->getEmail();
                    $displayName = $validated->getDisplayName();

                       if ($request->getPost()->usuario['organismo']) {
                           $organismo = $entityManager->find('Sip\Entity\Organismos', $request->getPost()->usuario['organismo']);
                           $usuario->setOrganismo($organismo);
                       }

                    $arrRoles	= $request->getPost()->roleid;
                    foreach ($arrRoles as $roleId):
                    $roles[] = $entityManager->find('Application\Entity\Role', $roleId);
                    endforeach;

                    $usuario->setRoles($roles);

                    $usuario->setUsername($username);
                    $usuario->setPassword($bcrypt->create($password));
                    $usuario->setEmail($email);
                    $usuario->setDisplayName($displayName);
                    $usuario->setState(1);

                    $entityManager->persist($usuario);

                    $entityManager->flush();

                    //$rUserGrupoTrabajo = new UserGrupoTrabajoReference();
                    //$usuarioid = $usuario->getId();
                    //$usuario = $entityManager->find('Application\Entity\User', $usuario->getId());
                    //foreach ($arrGrupos as $grupoId):
                    //$grupoId = $entityManager->find('Application\Entity\GrupoTrabajo', $grupoId);
                    //$rUserGrupoTrabajo->setUsuario($usuario);
                    //$rUserGrupoTrabajo->setGrupo($grupoId);
                    //endforeach;
                    //$entityManager->persist($rUserGrupoTrabajo);
                    //$entityManager->flush();

                    $this->flashMessenger()->addMessage('success_El usuario se creó con éxito!');

                    return $this->redirect()->toRoute('usuarios');

                    }
            }
            
            $form->get('submit')->setAttribute('value', 'Guardar');

            $this->view->setVariable('noticias', $usuario);
            $this->view->setVariable('form', $form);
            return $this->view;
            
            */
            
            
            
            
            
    }
        
    public function listarNoticiasAction()
    {
        //$this->getRenderer()->headScript()->appendFile('/js/confirm-deletion.js', 'text/javascript');
	//$this->getRenderer()->headLink()->appendStylesheet('/fancybox/jquery.fancybox.css');
		
		$entityManager = $this->getEntityManager();
		
		$matches = $this->getEvent()->getRouteMatch();
		$page   = $matches->getParam('page', 1);
		
		$noticias = $entityManager->getRepository('Admin\Entity\Noticias')->getEditables();
		
                //$this->view->setVariable('usuarios', $usuarios);
		
		$paginator = new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\ArrayAdapter($noticias));
		
		$paginator->setCurrentPageNumber($page);
		$paginator->setItemCountPerPage(20);
		
		$this->view->setVariable('lang', $matches->getParam('lang','es'));
		$this->view->setVariable('noticias', $paginator);
			
		return $this->view;
	    	 
	}

		    
    
}
