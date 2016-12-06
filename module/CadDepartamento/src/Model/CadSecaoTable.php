<?php

namespace CadDepartamento\Model;

use Controle\Db\TableGateway\AbstractTableGateway;
//use Zend\Db\Adapter\AdapterAwareInterface;

class CadSecaoTable extends AbstractTableGateway
{
    protected $primaryKey = 'secao_id';
	protected $tableName;
	protected $model;
	
	public function __construct(){
	    $this->model = new CadSecao();
	    $this->tableName = 'cad_secao';
	}
	
}



