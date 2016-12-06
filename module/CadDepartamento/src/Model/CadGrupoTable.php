<?php

namespace CadDepartamento\Model;

use Controle\Db\TableGateway\AbstractTableGateway;
//use Zend\Db\Adapter\AdapterAwareInterface;

class CadGrupoTable extends AbstractTableGateway
{
    protected $primaryKey = 'grupo_id';
	protected $tableName;
	protected $model;
	
	public function __construct(){
	    $this->model = new CadGrupo();
	    $this->tableName = 'cad_grupo';
	}
	
}



