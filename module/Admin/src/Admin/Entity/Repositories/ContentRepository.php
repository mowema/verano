<?php
namespace Admin\Entity\Repositories;


use Doctrine\ORM\EntityRepository;

class ContentRepository extends EntityRepository
{

    
    public function getActiveContent($state)
    {
    
    	$query = $this->_em->createQueryBuilder();
    	$query->select('c')
    	->from('Admin\Entity\Content', 'c')
    	->where('c.state = :state')
    	->orderBy('c.modified_date', 'DESC')
    	//->setFirstResult(0)
    	//->setMaxResults(5)
    	->setParameter('state', $state);
    	 
    	return $query->getQuery()->getResult();
    
    }
    
    public function getNoticiasUser($estado, $grupotrabajo, $idusuario, $tipo)
    {
    
    	$query = $this->_em->createQueryBuilder();
    	$query->select('n')
    	->from('Application\Entity\Noticia', 'n')
    	->where('n.estado = :estado')
    	->andWhere('n.grupo = :grupo')
    	->andWhere('n.tipo = :tipo')
    	->andWhere('n.usuario_c = :usuario')
    	->orderBy('n.fecha_creacion', 'DESC')
    	->setParameter('estado', $estado)
    	->setParameter('grupo', $grupotrabajo)
    	->setParameter('tipo', $tipo)
    	->setParameter('usuario', $idusuario);
    	 
    	return $query->getQuery()->getResult();
    
    }
    
    /*
     * FRONT
     */
    public function getNoticiaFromId($id)
    {
    	$query = $this->_em->createQueryBuilder();
    	$query->select('c')
    	->from('Admin\Entity\Content', 'c')
    	->where('c.state = 1')
    	->orderBy('c.modified_date', 'DESC');
    	 
    	return $query->getQuery()->getResult();
    	
    }
    
    public function getPublicContent()
    {
    
    	$query = $this->_em->createQueryBuilder();
    	$query->select('c')
    	->from('Admin\Entity\Content', 'c')
    	->where('c.state = :state')
    	->orderBy('c.modified_date', 'DESC')
    	->setFirstResult(0)
    	->setMaxResults(4)
    	->setParameter('state', '1');
    	 
    	return $query->getQuery()->getArrayResult();
    
    }
  
}
