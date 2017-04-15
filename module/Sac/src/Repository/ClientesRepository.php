<?php
namespace Sac\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Sac\Entity\Clientes;

// This is the custom repository class for Post entity.
class ClientesRepository extends EntityRepository
{
  // Finds all published posts having the given tag.
  public function findClientesByEmail($email)
  {
    $entityManager = $this->getEntityManager();
        
    $queryBuilder = $entityManager->createQueryBuilder();
     
    $queryBuilder->select('p')
        ->from(Clientes::class, 'p')
        ->where('p.email = ?1')
    	->setParameter(1, $email);

    $clientes = $queryBuilder->getQuery()->getResult();
    return $clientes;
  }        
}