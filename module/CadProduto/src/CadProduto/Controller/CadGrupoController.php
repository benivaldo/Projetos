<?php

namespace CadProduto\Controller;

use Controle\Controller\AbstractCrudController;
use CadProduto\Model\CadEan;
use CadProduto\Form\CadEanForm;

class CadEanController extends AbstractCrudController
{
    protected $albumTable;
    
    public function __construct()
    {
    	$this->tableGatewayClass = 'CadProduto\Model\CadEanTable';
    	$this->form = new CadEanForm();
    	$this->model = new CadEan();
    	$this->route = 'home';
    	$this->viewData = 'dados';
    	$this->pagination = true;
    	$this->template = 'cadean/index.phtml';
    	$this->div = '';
    	$this->primaryKey = null;
    	$this->searchFrase;
    	$this->searchDate;
    	$this->inner;
    	$this->campo = 'descricao';
    	$this->idTable = 'sku_id';
     }

    public function indexAction()
    {
    	return parent::indexAction();
    }

    public function editAction()
    {
        $this->div = $this->params('div');
        $this->route = 'cadproduto/index';
        $this->template = 'cadproduto/edit.phtml';
        return parent::editAction();
    }
    
    public function addAction()
    {
        $this->div = $this->params('div');
        $this->route = 'cadproduto/index';
        $this->template = 'cadproduto/add.phtml';
    	return parent::addAction();
    }
    
    public function deleteAction()
    {
       
        return parent::deleteAction();
    }
    
    public function gridAction()
    {
        return parent::gridAction();
    }
    
}
