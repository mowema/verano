<?php
namespace Admin\Entity\Repositories;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\AST\Join;

class MenuRepository extends EntityRepository
{

    public function getActiveItemMenu($state)
    {
    	 
    	$query = $this->_em->createQueryBuilder();
    	$query->select('m','p')
    	->from('Admin\Entity\Menu', 'm')
    	->innerJoin('m.parent', 'p')
    	->where('m.state = :state')
    	->orderBy('m.modified_date', 'DESC')
    	->setParameter('state', $state);
    	
    	return $query->getQuery()->getResult();
    
    }
            
    public function getActiveMenu($state, $menu)
    {
    
    	$query = $this->_em->createQueryBuilder();
    	$query->select('m','p')
    	->from('Admin\Entity\Menu', 'm')
    	->innerJoin('m.parent', 'p')
    	->where('p.id = :menu')
    	->andWhere('m.state = :state')
    	->setParameter('state', $state)
    	->setParameter('menu', $menu);
    	 
    	return $query->getQuery()->getResult();
    
    }
    
    public function getActiveMenus($state)
    {
    //SELECT m.*, (SELECT COUNT(DISTINCT m1.id) FROM menu AS m1 WHERE m1.parent_id = m.id) AS ChildCount FROM menu AS m
    	$query = $this->_em->createQueryBuilder();
    	$query->select('m','par.id AS parent','(SELECT COUNT(DISTINCT m1.id) FROM Admin\Entity\Menu AS m1 JOIN m1.parent as p WHERE p.id = m.id) AS cc')
    	->from('Admin\Entity\Menu', 'm')
    	->innerJoin('m.parent', 'par')
    	->where('m.state = :state')
  //  	->orderBy('m.modified_date', 'DESC')
    	->setParameter('state', $state);
    	 
    	return $query->getQuery()->getArrayResult();
    }
    
    

    public function getActiveFromAMenu($state)
    {
    	//SELECT m.*, (SELECT COUNT(DISTINCT m1.id) FROM menu AS m1 WHERE m1.parent_id = m.id) AS ChildCount FROM menu AS m
    	$query = $this->_em->createQueryBuilder();
    	$query->select('m','par.id AS parent','(SELECT COUNT(DISTINCT m1.id) FROM Admin\Entity\Menu AS m1 JOIN m1.parent as p WHERE p.id = m.id) AS cc')
    	->from('Admin\Entity\Menu', 'm')
    	->innerJoin('m.parent', 'par')
    	->where('m.state = :state')
    	//->andWhere('par.id = :parent')
    	//  	->orderBy('m.modified_date', 'DESC')
    	->setParameter('state', $state);
    	//->setParameter('parent', $parent);
    
    	return $query->getQuery()->getArrayResult();
    
    }
    
    
  /*  
    function getOneLevel($catId){
    	$query=mysql_query("SELECT categoryId FROM categories WHERE categoryMasterId='".$catId."'");
    	$cat_id=array();
    	if(mysql_num_rows($query)>0){
    		while($result=mysql_fetch_assoc($query)){
    			$cat_id[]=$result['categoryId'];
    		}
    	}
    	return $cat_id;
    }
    
    function getChildren($parent_id, $tree_string=array()) {
    	$tree = array();
    	// getOneLevel() returns a one-dimensional array of child ids
    	$tree = $this->getOneLevel($parent_id);
    	if(count($tree)>0 && is_array($tree)){
    		$tree_string=array_merge($tree_string,$tree);
    	}
    	foreach ($tree as $key => $val) {
    		$this->getChildren($val, &$tree_string);
    	}
    	return $tree_string;
    }
    
    */
    
    
    
    /**
     * 
     * 
     * 
     * 
     * @param unknown $estado
     * @param unknown $grupotrabajo
     * @param unknown $idusuario
     * @param unknown $tipo
     * @return Ambigous <multitype:, \Doctrine\ORM\mixed, \Doctrine\DBAL\Driver\Statement, \Doctrine\Common\Cache\mixed>
     */
    
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
