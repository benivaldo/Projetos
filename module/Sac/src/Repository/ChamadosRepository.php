<?php
namespace Sac\Repository;

use Doctrine\ORM\EntityRepository;
use Sac\Entity\Chamados;
use Sac\Entity\Clientes;
use Zend\Db\Sql\Where;

class ChamadosRepository extends EntityRepository
{
  // Finds all published posts having the given tag.
  public function findChamados($orderBy, $order, $search = '')
  {
    $entityManager =  $this->getEntityManager();       
        
    $queryBuilder = $entityManager->createQueryBuilder();
     
    $queryBuilder
        ->select('t', 'c', 'p')
        ->from(Chamados::class, 't')
        ->innerJoin('t.clientes', 'c')
        ->innerJoin('t.pedidos', 'p')    	
        ->where('t.pedidos = ?1')
        ->orWhere('t.email LIKE ?2')
        ->orderBy("t.$orderBy", $order)
        ->setParameter('1', (int)$search)
        ->setParameter('2', '%'.$search.'%');
    
    $chamados = $queryBuilder->getQuery();
    //echo $chamados->getSQL();
    return $chamados;
  }        
}