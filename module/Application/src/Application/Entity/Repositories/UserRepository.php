<?php
namespace Application\Entity\Repositories;

use Zend\Debug\Debug;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function getUsuariosNoAsignados($grupoId)
    {
    	
		$query = $this->_em->createQueryBuilder();
    	$query->select('u')
            ->from('Application\Entity\User', 'u')
            ->where('u.id NOT IN (SELECT IDENTITY (ugt.usuario) FROM Application\Entity\UserGrupoTrabajoReference ugt WHERE ugt.grupo = :grupoId)')
            ->setParameter('grupoId', $grupoId);
        	
    	return $query->getQuery()->getResult();	
    }
    
    public function getUsuariosActivos($state)
    {
    	$query = $this->_em->createQueryBuilder();
    	$query->select('u')
    	->from('Application\Entity\User', 'u')
    	->where('u.state = :state')
    	->setParameter('state', $state);
    
    	return $query->getQuery()->getResult();
    }
    
    public function getPermisosUsuariosActivos($state)
    {
    	$query = $this->_em->createQueryBuilder();
    	$query->select('u')
    	->from('Application\Entity\User', 'u')
    	->where('u.state = :state')
    	->setParameter('state', $state);
    
    	return $query->getQuery()->getResult();
    }
    
    public function getRutaDeUsuario($id)
    {
    	$query = $this->_em->createQueryBuilder();
    	$query->select('u.ruta')
    	->from('Application\Entity\User', 'u')
    	->where('u.id = :id')
    	->setParameter('id', $id);
    
    	return $query->getQuery()->getResult();
    }
    
    public function getUsuarioPorMail($state)
    {
    	$query = $this->_em->createQueryBuilder();
    	$query->select('u')
    	->from('Application\Entity\User', 'u')
    	->where('u.state = :state')
    	->setParameter('state', $state);
    
    	return $query->getQuery()->getResult();
    }
  
}
