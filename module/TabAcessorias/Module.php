<?php

namespace TabAcessorias;



class Module
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
            		__DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                    'Controle' => realpath(__DIR__ . '/../../vendor/controle/generic/library/Controle'),
                ),
            ),
        );
    }
    
    
    public function getServiceConfig()
    {
    	return array(
         	    'abstract_factories' => array(
        	    		'AbstractTable' => 'Controle\Service\Factory\ModelAbstractFactory',
        	    ),
    	);
    }


    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}