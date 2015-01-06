<?php
namespace Application\Entity\Repositories;

use Zend\Debug\Debug;

use Doctrine\ORM\EntityRepository;

class RoleRepository extends EntityRepository
{
	public function getRolesActivos($state)
    {
    	$query = $this->_em->createQueryBuilder();
    	$query->select('r')
    	->from('Application\Entity\Role', 'r')
    	->where('r.state = :state')
    	->setParameter('state', $state);
    
    	return $query->getQuery()->getResult();
    
    }
  
}
