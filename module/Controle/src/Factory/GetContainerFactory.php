<?php

namespace Controle\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Controle\Db\TableGateway\AbstractTableGateway;

class GetContainerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        //$adapter = $container->get('Zend\Db\Adapter\Adapter');
  
        return new AbstractTableGateway($container);
    }

}
