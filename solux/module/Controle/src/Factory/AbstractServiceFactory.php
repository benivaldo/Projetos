<?php

namespace Controle\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\AbstractFactoryInterface;

class AbstractServiceFactory implements AbstractFactoryInterface
{
    public function canCreate(ContainerInterface $container, $requestedName)
    {
        /*echo "</br>";
        echo 'Response Server :'.$requestedName;
        echo "</br>";*/
        //$isClassExists = class_exists($requestedName);
        return class_exists($requestedName);
    }
    
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
       /* echo "</br>";
        echo 'Request Server :'.$requestedName;
        echo "</br>";*/
        return new $requestedName($container);
    }

    
}
