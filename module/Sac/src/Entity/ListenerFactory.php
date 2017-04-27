<?php

namespace Sac\Entity;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Sac\Entity\ChamadosListener;

class ListenerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
      echo $requestedName;
        return new ChamadosListener($container);
    }

}
