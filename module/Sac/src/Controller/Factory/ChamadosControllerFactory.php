<?php
namespace Sac\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Sac\Controller\ChamadosController;

/**
 * This is the factory for ChamadosController. Its purpose is to instantiate the
 * controller.
 */
class ChamadosControllerFactory implements FactoryInterface
{
	public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
	{
		$entityManager = $container->get('doctrine.entitymanager.orm_default');

		// Instantiate the controller and inject dependencies
		return new ChamadosController($entityManager, $container);
	}
}