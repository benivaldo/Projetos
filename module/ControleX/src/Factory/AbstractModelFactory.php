<?php
namespace Controle\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\AbstractFactoryInterface; // <-- note the change!

class AbstractModelFactory  implements AbstractFactoryInterface
{
    public function canCreate(ContainerInterface $container, $requestedName)
    {
        /*echo "</br>";
        echo 'Request Model :'.$requestedName;
        echo "</br>";*/
        return (fnmatch('*Table', $requestedName)) ? true : false;
    }

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /*echo "</br>";
        echo 'Response Model :'.$requestedName;
        echo "</br>";*/
        $db = $container->get('Zend\Db\Adapter\Adapter');
		$tableModel = new $requestedName;
		$tableModel->setDbAdapter($db);
		//$cacheAdapter = $container->get('Zend\Cache\Storage\Filesystem');
		//$tableModel->setCache($cacheAdapter);
		return $tableModel;
    }
}