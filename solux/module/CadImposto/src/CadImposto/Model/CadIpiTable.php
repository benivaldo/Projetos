<?php

namespace CadImposto\Model;

use Controle\Db\TableGateway\AbstractTableGateway;
//use Zend\Db\Adapter\AdapterAwareInterface;

class CadIpiTable extends AbstractTableGateway
{
    protected $primaryKey = 'ipi_id';
	protected $tableName;
	protected $model;
	
	public function __construct(){
	    $this->model = new CadIpi();
	    $this->tableName = 'cad_ipi';
	}
	
}



