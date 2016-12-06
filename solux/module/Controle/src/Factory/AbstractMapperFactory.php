<?php

namespace Controle\Factory;

use Interop\Container\ContainerInterface;
use Controle\Db\TableGateway;
use Zend\Db\Adapter\AdapterInterface;
use Zend\ServiceManager\Factory\AbstractFactoryInterface;

class AbstractMapperFactory implements AbstractFactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /**
         * @var CommonTableGateway $requestedName
         * @var CommonEntity $entity
         */
        echo "</br>";
        echo 'Request Mapper :'.$requestedName;
        echo "</br>";
        $entityName = str_replace('Mapper', 'Table', $requestedName);
        $entity = new $entityName();
        $mapper = new $requestedName($container->get(AdapterInterface::class), $entity);

        return $mapper;
    }

    public function canCreate(ContainerInterface $container, $requestedName)
    {
       echo "</br>";
        echo 'Response Mapper :'.$requestedName;
        echo "</br>";
        $entityName = str_replace('Mapper', 'Table', $requestedName);

        $isClassExists = class_exists($requestedName);
        $isEntityExists = class_exists($entityName);
        $isMapper = preg_match('/^[a-z]+\\\Mapper\\\.*Mapper/i', $requestedName);

        return (
            $isClassExists && $isEntityExists && $isMapper
        );
    }
}
