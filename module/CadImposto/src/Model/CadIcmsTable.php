<?php

namespace CadImposto\Model;

use Controle\Db\TableGateway\AbstractTableGateway;
//use Zend\Db\Adapter\AdapterAwareInterface;

class CadIcmsTable extends AbstractTableGateway
{
    protected $primaryKey = 'icms_id';
	protected $tableName;
	protected $model;
	
	public function __construct(){
	    $this->model = new CadIcms();
	    $this->tableName = 'cad_icms';
	}
	
}



