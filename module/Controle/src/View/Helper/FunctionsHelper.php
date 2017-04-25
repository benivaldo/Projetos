<?php
namespace Controle\View\Helper;
use Zend\View\Helper\AbstractHelper;

class FunctionsHelper extends AbstractHelper
{
    protected $container;
    protected $service;    
    
    public function __construct($container, $service)
    {
        $this->container = $container;
        $this->service = $service;
    }
    
	public function __invoke()
	{		
		return $this->service;
	}
}