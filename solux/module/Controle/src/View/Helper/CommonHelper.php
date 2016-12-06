<?php

namespace Controle\View\Helper;

use Interop\Container\ContainerInterface;
use Zend\View\Helper\AbstractHelper;

class CommonHelper extends AbstractHelper
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}
