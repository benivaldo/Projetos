<?php

namespace TabAcessorias\Model;

use Controle\Db\TableGateway\AbstractTableGateway;
//use Zend\Db\Adapter\AdapterAwareInterface;

class TabCidadesTable extends AbstractTableGateway
{
    protected $primaryKey = 'cidade_id';
	protected $tableName;
	protected $model;
	
	public function __construct(){
	    $this->model = new TabCidades();
	    $this->tableName = 'tab_cidade';
	}
	
}



