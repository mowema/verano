<?php
namespace Admin\Entity\Repositories;

use Doctrine\ORM\EntityRepository;

class NoticiasRepository extends EntityRepository
{

    public function getEditables()
    {

    	$query = $this->_em->createQueryBuilder();
    	$query->select('n')
    	->from('Admin\Entity\Noticias', 'n')
    	->where('n.state >= 0')
    	->setFirstResult(0)
    	->setMaxResults(10)
        ->orderBy('n.id','DESC');
    	
    	return $query->getQuery()->getResult();
    
    }

    public function getActivas($count=10)
    {

    	$query = $this->_em->createQueryBuilder();
    	$query->select('n')
    	->from('Admin\Entity\Noticias', 'n')
    	->where('n.state = :state')
    	->setFirstResult(0)
    	->setMaxResults($count)
                // tengo que buscar por fecha
        ->orderBy('n.id','DESC')
    	->setParameter('state', 1);
    	
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
