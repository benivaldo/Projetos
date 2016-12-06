<?php

namespace CadImposto\Model;

use Controle\Db\TableGateway\AbstractTableGateway;
//use Zend\Db\Adapter\AdapterAwareInterface;

class CadPisTable extends AbstractTableGateway
{
    protected $primaryKey = 'pis_id';
	protected $tableName;
	protected $model;
	
	public function __construct(){
	    $this->model = new CadPis();
	    $this->tableName = 'cad_pis';
	}
	
}



