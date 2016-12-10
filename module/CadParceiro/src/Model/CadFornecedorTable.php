<?php

namespace CadParceiro\Model;

use Controle\Db\TableGateway\AbstractTableGateway;
//use Zend\Db\Adapter\AdapterAwareInterface;

class CadFornecedorTable extends AbstractTableGateway
{
    protected $primaryKey = 'fornecedor_id';
	protected $tableName;
	protected $model;
	
	public function __construct(){
	    $this->model = new CadFornecedor();
	    $this->tableName = 'cad_fornecedor';
	}
	
}



