<?php
namespace Sac\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\AbstractFactoryInterface; // <-- note the change!
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class CommonControllerFactory implements AbstractFactoryInterface
{
    public function canCreate(ContainerInterface $container, $requestedName)
    {
    	//echo $requestedName;
    	
        return (fnmatch('*Controller', $requestedName)) ? true : false;
    }

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
      	$entityManager = $container->get('doctrine.entitymanager.orm_default');
      	
		return new $requestedName($entityManager, $container);
    }
}