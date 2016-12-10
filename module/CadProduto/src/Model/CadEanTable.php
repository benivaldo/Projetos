<?php

namespace CadProduto\Model;

use Controle\Db\TableGateway\AbstractTableGateway;
//use Zend\Db\Adapter\AdapterAwareInterface;

class CadEanTable extends AbstractTableGateway
{
    protected $primaryKey = 'sku_id';
	protected $tableName;
	protected $model;
	
	public function __construct(){
	    $this->model = new CadEan();
	    $this->tableName = 'cad_ean';
	}
	
}



