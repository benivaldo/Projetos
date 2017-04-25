<?php
namespace Controle\Service\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Controle\Service\HelperService;

class HelperServiceFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
      	$entityManager = $container->get('doctrine.entitymanager.orm_default');
      	
		return new HelperService($entityManager, $container);
    }
}

