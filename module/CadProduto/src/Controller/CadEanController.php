<?php

namespace CadProduto\Controller;

use Controle\Controller\AbstractCrudController;
use CadProduto\Model\CadEan;
use CadProduto\Form\CadEanForm;

class CadEanController extends AbstractCrudController
{
    protected $albumTable;
    
    public function getVariaveis()
    {
    	$this->tableGatewayClass = 'CadProduto\Model\CadEanTable';
    	$this->form = new CadEanForm();
    	$this->model = new CadEan();
    	$this->route = 'home';
    	$this->viewData = 'dados';
    	$this->pagination = true;
    	$this->template = 'cadproduto/cadean/index.phtml';
    	$this->div = '';
    	$this->primaryKey = null;
    	$this->searchFrase;
    	$this->searchDate;
    	$this->inner;
    	$this->campo = 'descricao';
    	$this->idTable = 'sku_id';
    	$this->colDataPesq = 'data_cadastro';
    	$this->whereCampo;
    	$this->colunas;
    	$this->order_by = 'sku_id';
    	$this->group_by;
     }

    public function indexAction()
    {
        $this->getVariaveis();
        
        $this->whereCampo['plu_id'] = strtolower($this->params('id'));
        
    	return parent::indexAction();
    }

    public function editAction()
    {
        $this->getVariaveis();
        
        $this->div = $this->params('div');
        $this->route = 'cadproduto/index';
        $this->template = 'cadproduto/edit.phtml';
        return parent::editAction();
    }
    
    public function addAction()
    {
        $this->getVariaveis();
        $this->div = $this->params('div');
        $this->route = 'cadproduto/index';
        $this->template = 'cadproduto/add.phtml';
    	return parent::addAction();
    }
    
    public function deleteAction()
    {
        $this->getVariaveis();
       
        return parent::deleteAction();
    }
    
    public function gridAction()
    {
        return parent::gridAction();
    }
    
}
