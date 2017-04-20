<?php
namespace Controle\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\AbstractFactoryInterface; // <-- note the change!

class ControleFormFactory implements AbstractFactoryInterface
{
	public function canCreate(ContainerInterface $container, $requestedName)
	{
		return (fnmatch('*Form', $requestedName)) ? true : false;
	}

	public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
	{
		$entityManager = $container->get('doctrine.entitymanager.orm_default');
		return new $requestedName($entityManager);
	}
}