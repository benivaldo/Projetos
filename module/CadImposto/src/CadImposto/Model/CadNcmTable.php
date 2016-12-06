<?php

namespace CadImposto\Model;

use Controle\Db\TableGateway\AbstractTableGateway;
//use Zend\Db\Adapter\AdapterAwareInterface;

class CadNcmTable extends AbstractTableGateway
{
    protected $primaryKey = 'ncm_id';
	protected $tableName;
	protected $model;
	
	public function __construct(){
	    $this->model = new CadNcm();
	    $this->tableName = 'cad_ncm';
	}
	
}



