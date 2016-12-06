<?php
namespace Controle\View\Helper;
use Zend\View\Helper\AbstractHelper;

class GetSelectOptions extends AbstractHelper
{
	public function __construct($sql)
	{
		$query = $sql;
		$statement = $this->getView()->getHelperPluginManager()->getServiceLocator()->get('Zend\Db\Adapter\Adapter')->query($query);
		$result = $statement->execute();
		$selectData = array();
	
		foreach ($result as $res) {
			$selectData[$res['id']] = $res['data'];
		}

		return $selectData;
	}
}