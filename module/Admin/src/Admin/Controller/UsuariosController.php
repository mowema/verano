<?php

namespace Admin\Controller;

use Zend\Debug\Debug;
use Application\Entity\UserGrupoTrabajoReference;
use Zend\Session\Container;
use Zend\Crypt\Password\Bcrypt;
use Application\Entity\User;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Form\UsuarioForm;
use Doctrine\ORM\EntityManager;
use Zend\EventManager\EventManagerInterface;

class UsuariosController extends AbstractActionController {

    const ROUTE_CHANGEPASSWD = 'zfcuser/changepassword';
    const ROUTE_LOGIN = 'zfcuser/login';
    const ROUTE_REGISTER = 'zfcuser/register';
    const ROUTE_CHANGEEMAIL = 'zfcuser/changeemail';
    const CONTROLLER_NAME = 'zfcuser';

    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;
    protected $grupotrabajo;
    protected $renderer;
    protected $view;

    public function onDispatch(\Zend\Mvc\MvcEvent $e) {
        if (!$this->zfcUserAuthentication()->hasIdentity()) {
            return $this->redirect()->toRoute(static::ROUTE_LOGIN);
        }
        if (!$this->isAllowed('usuarios', 'index', 'crear', 'editar', 'apapelera')) {

            throw new \BjyAuthorize\Exception\UnAuthorizedException('al ingresar a esta accion');
        }
        return parent::onDispatch($e);
    }

    public function __construct() {
        $this->view = new ViewModel();
        //$container = new Container('grupo');
        //$this->grupotrabajo = $container->grupo;
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
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    public function indexAction() {

        $this->getRenderer()->headScript()->appendFile('/js/confirm-deletion.js', 'text/javascript');
        $this->getRenderer()->headLink()->appendStylesheet('/fancybox/jquery.fancybox.css');

        $entityManager = $this->getEntityManager();

        $matches = $this->getEvent()->getRouteMatch();
        $page = $matches->getParam('page', 1);

        $usuarios = $entityManager->getRepository('Application\Entity\User')->getUsuariosActivos(1);
        $this->view->setVariable('usuarios', $usuarios);

        $paginator = new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\ArrayAdapter($usuarios));

        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage(20);

        $this->view->setVariable('lang', $matches->getParam('lang', 'es'));
        $this->view->setVariable('usuarios', $paginator);

        return $this->view;
    }

    public function crearAction() {

        $entityManager = $this->getEntityManager();
        $form = new UsuarioForm($entityManager);
        $request = $this->getRequest();
        $bcrypt = new Bcrypt();

        $usuario = new User();

        if ($request->isPost()) {

            $post = $request->getPost()->toArray();
            $form->setData($post);

            if ($form->isValid()) {

                $validated = $form->getData();

                $username = $validated->getUsername();
                $password = $validated->getPassword();
                $email = $validated->getEmail();
                $displayName = $validated->getDisplayName();

                $arrRoles = $request->getPost()->roleid;

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
    }

    public function editarAction() {

        $request = $this->getRequest();
        $entityManager = $this->getEntityManager();
        $bcrypt = new Bcrypt();

        $id = (int) $this->getEvent()->getRouteMatch()->getParam('id');

        if (!$id) {
            return $this->redirect()->toRoute('application', array('action' => 'index'));
        }

        $usuario = $this->getEntityManager()->find('Application\Entity\User', $id);


        $form = new UsuarioForm($entityManager, $id);
        //$form->setValidationGroup('username', 'email', 'organismo', 'displayName');

        if ($request->isPost()) {

            $post = $request->getPost()->toArray();
            $form->setData($post);
            //echo $request->getPost()->usuario['password'];
            if ($request->getPost()->usuario['password'] == ""){
            $form->getInputFilter()->get('usuario')->remove('password');}
            //echo'<pre>';
            //var_dump($form->getInputFilter());die;
            if ($form->isValid()) {

                $username = $request->getPost()->usuario['username'];

                $password = $request->getPost()->usuario['password'];
                $email = $request->getPost()->usuario['email'];
                $displayName = $request->getPost()->usuario['displayName'];

                if ($request->getPost()->usuario['organismo']) {
                    $organismo = $entityManager->find('Sip\Entity\Organismos', $request->getPost()->usuario['organismo']);
                    $usuario->setOrganismo($organismo);
                }

                //$organismo = $request->getPost()->usuario['organismo'];
                $arrRoles = $request->getPost()->roleid;

                foreach ($arrRoles as $roleId):
                    $roles[] = $entityManager->find('Application\Entity\Role', $roleId);
                endforeach;

                $usuario->setRoles($roles);

                $usuario->setUsername($username);
                if ($request->getPost()->usuario['password'])
                    $usuario->setPassword($bcrypt->create($password));
                $usuario->setEmail($email);
                $usuario->setDisplayName($displayName);
                $usuario->setState(1);

                $this->getEntityManager()->persist($usuario);
                $this->getEntityManager()->flush();
                $this->flashMessenger()->addMessage('success_El usuario se modificó con éxito!');

                return $this->redirect()->toRoute('usuarios');
            }
        }


        $form->bind($usuario);

        $this->view->setVariable('id', $id);
        $this->view->setVariable('form', $form);

        return $this->view;
    }

    public function apapeleraAction() {

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

    public function activargrupoAction() {

        $entityManager = $this->getEntityManager();

        $matches = $this->getEvent()->getRouteMatch();

        $idGrupo = $matches->getParam('grupo');
        $controlador = (string) $matches->getParam('controlador');
        $grupotrabajo = $this->getEntityManager()->find('Application\Entity\GrupoTrabajo', $idGrupo);

        $container = new Container('grupo');
        $container->grupo = $idGrupo;
        $container->grupoNombre = $grupotrabajo->getNombre();

        return $this->redirect()->toRoute($controlador);
    }

    public function informeAction() {

        $entityManager = $this->getEntityManager();
        $idusuario = (int) $this->getEvent()->getRouteMatch()->getParam('id');

        if (!$idusuario) {
            echo ('nada para mostrar');
            return $this->response;
        }

        $usuario = $this->getEntityManager()->find('Application\Entity\User', $idusuario);

        $noticias = $entityManager->getRepository('Application\Entity\Noticia')->getNoticiasUser(1, $this->grupotrabajo, $idusuario, 1);

        $this->view->setVariable('usuario', $usuario);
        $this->view->setVariable('noticias', $noticias);

        $this->layout('layout/blank.phtml');

        return $this->view;
    }

}
