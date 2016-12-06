<?php

namespace Controle\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\AbstractFactoryInterface;
use Zend\Stdlib\DispatchableInterface;

class AbstractControllerFactory implements AbstractFactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /*echo "</br>";
        echo 'Request'.$requestedName;
        echo "</br>";*/
        return new $requestedName($container);
    }

    public function canCreate(ContainerInterface $container, $requestedName)
    {
       /* echo "</br>";
        echo 'Solicitação'.$requestedName;
        echo "</br>";*/
        $isClassExists = class_exists($requestedName);
        $isDispatchable = in_array(DispatchableInterface::class, class_implements($requestedName));
        $isController = preg_match('/^[a-z]+\\\Controller\\\.*Controller/i', $requestedName);

        return (
            $isClassExists && $isDispatchable && $isController
        );
    }
}
