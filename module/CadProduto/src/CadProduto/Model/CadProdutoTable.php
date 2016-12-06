<?php

namespace CadProduto\Model;

use Controle\Db\TableGateway\AbstractTableGateway;
//use Zend\Db\Adapter\AdapterAwareInterface;

class CadProdutoTable extends AbstractTableGateway
{
    protected $primaryKey = 'produto_id';
	protected $tableName;
	protected $model;
	
	public function __construct(){
	    $this->model = new CadProduto();
	    $this->tableName = 'cad_produto';
	}
	
}



