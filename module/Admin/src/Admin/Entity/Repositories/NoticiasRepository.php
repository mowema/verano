<?php
namespace Admin\Entity\Repositories;

use Doctrine\ORM\EntityRepository;

class NoticiasRepository extends EntityRepository
{

    public function getActiveNoticias($state)
    {

    	$query = $this->_em->createQueryBuilder();
    	$query->select('cat')
    	->from('Admin\Entity\Category', 'cat')
    	->where('cat.state = :state')
    	->orderBy('cat.modified_date', 'DESC')
    	->setFirstResult(0)
    	->setMaxResults(5)
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
   
  
}
