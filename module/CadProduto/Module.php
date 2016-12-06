<?php

namespace CadProduto;

use CadProduto\Model\CadProduto;


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
    			/*'invokables' => array(
    					'Album\Model\AlbumTable' => 'Album\Model\AlbumTable',
    			),*/
    	    
        	    'abstract_factories' => array(
        	    		'AbstractTable' => 'Controle\Service\Factory\ModelAbstractFactory',
        	    ),
    	    
    			/*'initializers' => array(
    					function ($instance, ServiceLocatorInterface $sm) {
    						if ($instance instanceof AdapterAwareInterface)
    						{
    							$instance->setDbAdapter($sm->get('Zend\Db\Adapter\Adapter'));
    						}
    					}
    			),*/
    	);
    }


    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}