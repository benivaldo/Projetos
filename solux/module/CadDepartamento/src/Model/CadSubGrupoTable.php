<?php

namespace CadDepartamento\Model;

use Controle\Db\TableGateway\AbstractTableGateway;
//use Zend\Db\Adapter\AdapterAwareInterface;

class CadSubGrupoTable extends AbstractTableGateway
{
    protected $primaryKey = 'subgrupo_id';
	protected $tableName;
	protected $model;
	
	public function __construct(){
	    $this->model = new CadSubGrupo();
	    $this->tableName = 'cad_subgrupo';
	}
	
}



