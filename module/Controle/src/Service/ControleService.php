<?php
namespace Controle\Service;

class ControleService {
    
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;
    
    // Constructor method is used to inject dependencies to the controller.
    public function __construct($entityManager, $container)
    {
        $this->entityManager = $entityManager;
        $this->container = $container;
    }
    
    
    public function getContainer ()
    {
        return $this->container;
    }
    
    public function getEntity()
    {
        return $this->entityManager;
    }
}