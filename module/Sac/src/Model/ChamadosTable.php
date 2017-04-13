<?php

namespace Sac\Model;

use Controle\Db\TableGateway\AbstractTableGateway;
//use Zend\Db\Adapter\AdapterAwareInterface;

class ChamadosTable extends AbstractTableGateway
{
    protected $primaryKey = 'secao_id';
	protected $tableName;
	protected $model;
	
	public function __construct(){
	    $this->model = new Chamados();
	    $this->tableName = 'cad_secao';
	}
	
}



