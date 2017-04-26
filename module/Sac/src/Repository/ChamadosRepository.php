<?php
namespace Sac\Repository;

use Doctrine\ORM\EntityRepository;
use Sac\Entity\Chamados;
use Sac\Entity\Clientes;
use Zend\Db\Sql\Where;

class ChamadosRepository extends EntityRepository
{
  // Finds all published posts having the given tag.
  public function findAllData($orderBy, $order, $search = '', $data_ini = null, $data_fin = null)
  {
    $entityManager =  $this->getEntityManager();       
        
    $queryBuilder = $entityManager->createQueryBuilder();
    //Select normal 
    $queryBuilder
        ->select('t', 'c', 'p')
        ->from(Chamados::class, 't')
        ->innerJoin('t.clientes', 'c')
        ->innerJoin('t.pedidos', 'p');    	
    
	//Campo where   
    $queryBuilder->where($queryBuilder->expr()->orX(
    		$queryBuilder->expr()->eq('t.id','?1'),
    		$queryBuilder->expr()->eq('t.pedidos','?1'),
	       	$queryBuilder->expr()->like('t.email', '?2')
   	));
    
    $params = array('1' => (int)$search, '2' => '%'.$search.'%');
    
    //Campo de pesquisa data
   	if (!empty($data_ini) && !empty($data_fin)) {
   		$queryBuilder->andWhere($queryBuilder->expr()->andX( 
   				$queryBuilder->expr()->between(
	  				't.data_cadastro',
	      			':from',
	      			':to'
   				)
	        )
	 	);
   		
   		$params['from'] = $data_ini;
   		$params[ 'to'] = $data_fin;
  	}
  	
  	//Campos as serem ordenados
  	switch ($orderBy) {
  		default:
  			$campo = "t.$orderBy";
  			break;
  		case 'nome':
  			$campo = "c.nome";
  			break;
  	}
        
    $queryBuilder->orderBy($campo, $order);
  	
  	$queryBuilder->setParameters($params);
    
    $chamados = $queryBuilder->getQuery();

    return $chamados;
  }        
}