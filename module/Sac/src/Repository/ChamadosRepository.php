<?php
namespace Sac\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Sac\Entity\Chamados;

// This is the custom repository class for Post entity.
class ChamadosRepository extends EntityRepository
{
  // Finds all published posts having the given tag.
  public function findChamados($orderBy, $order)
  {
    $entityManager = $this->getEntityManager();
        
    $queryBuilder = $entityManager->createQueryBuilder();
     
    $queryBuilder->select('p')
        ->from(Chamados::class, 'p')  
    	->orderBy("p.$orderBy", $order);
	      
    $posts = $queryBuilder->getQuery();
    return $posts;
  }        
}