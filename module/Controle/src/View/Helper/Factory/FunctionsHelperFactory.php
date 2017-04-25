<?php

namespace Controle\View\Helper\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Controle\View\Helper\FunctionsHelper;
use Controle\Service\HelperService;

class FunctionsHelperFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $service = $container->get(HelperService::class);
        
        return new FunctionsHelper($container, $service);
    }

}
