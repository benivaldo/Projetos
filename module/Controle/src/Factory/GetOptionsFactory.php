<?php

namespace Controle\Factory;

use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class GetOptionsFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /**
         * @var CommonTableGateway $requestedName
         * @var CommonEntity $entity
         */
        echo "</br>";
        echo 'Request Options :'.$requestedName;
        echo "</br>";
  
        return $requestedName;
    }

}
