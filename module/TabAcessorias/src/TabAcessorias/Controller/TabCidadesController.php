<?php

namespace TabAcessorias\Controller;

use Controle\Controller\AbstractCrudController;
use TabAcessorias\Model\TabCidades;

class TabCidadesController extends AbstractCrudController
{
    protected $grupoTable;
    
    public function __construct()
    {
    	$this->tableGatewayClass = 'TabAcessorias\Model\TabCidadesTable';
    	$this->form = '';
    	$this->model = new TabCidades();
    	$this->route = 'home';
    	$this->viewData = 'dados';
    	$this->pagination = true;
    	$this->template = '';
    	$this->div = '';
    	$this->primaryKey = null;
    	$this->searchFrase;
    	$this->searchDate;
    	$this->inner;
    	$this->campo = '';
    	$this->idTable = '';
    	$this->colDataPesq = '';
    	$this->whereCampo;
    	$this->colunas;
    	$this->order_by;
    	$this->group_by;
    }

    public function indexAction()
    {
    	return parent::indexAction();
    }

    public function editAction()
    {
         return parent::editAction();
    }
    
    public function addAction()
    {
    	return parent::addAction();
    }
    
    public function deleteAction()
    {
        return parent::deleteAction();
    }
    
    public function prevAction()
    {
        return parent::prevAction();
    }
    
    public function nextAction()
    {
        return parent::nextAction();
    }
    
    public function gridAction()
    {
        return parent::gridAction();
    }
    
    public function getAction()
    {
        $this->colunas = array('id' => 'codigo', 'nome' => 'cidade' );
        $this->order_by = 'nome'; // Colocar o mesmo do campo da coluna caso seja usado o alias usar o nome do alias
        $this->group_by = array('id', 'nome');
        $this->whereCampo = array("uf = ".$this->params('id'));
        return parent::getAction();
    }
    
}
