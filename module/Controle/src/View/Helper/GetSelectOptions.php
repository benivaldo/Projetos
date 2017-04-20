<?php
namespace Controle\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Interop\Container\ContainerInterface;

class GetSelectOptions extends AbstractHelper
{
    private $container;
    
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    
	public function __invoke($sql)
	{
		$query = $sql;
		$statement = $this->container->get('Zend\Db\Adapter\Adapter')->query($query);
		$result = $statement->execute();
		$selectData = array();
	
		foreach ($result as $res) {
			$selectData[$res['id']] = $res['data'];
		}

		return $selectData;
	}
}