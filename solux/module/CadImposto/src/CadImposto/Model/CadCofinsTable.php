<?php

namespace CadImposto\Model;

use Controle\Db\TableGateway\AbstractTableGateway;
//use Zend\Db\Adapter\AdapterAwareInterface;

class CadCofinsTable extends AbstractTableGateway
{
    protected $primaryKey = 'cofins_id';
	protected $tableName;
	protected $model;
	
	public function __construct(){
	    $this->model = new CadCofins();
	    $this->tableName = 'cad_cofins';
	}
	
}



