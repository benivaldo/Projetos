<?php

namespace Controle\Db\TableGateway;

use Interop\Container\ContainerInterface;

abstract class CommonCrudTableGateway
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}
