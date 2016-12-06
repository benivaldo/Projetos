<?php

namespace CadParceiro\Controller;

use Controle\Controller\AbstractCrudController;
use CadParceiro\Model\CadFornecedor;
use CadParceiro\Form\CadFornecedorForm;

class CadFornecedorController extends AbstractCrudController
{
    protected $cadFornecedorTable;
    
    public function __construct()
    {
    	$this->tableGatewayClass = 'CadParceiro\Model\CadFornecedorTable';
    	$this->form = new CadFornecedorForm();
    	$this->model = new CadFornecedor();
    	$this->route = 'home';
    	$this->viewData = 'dados';
    	$this->pagination = true;
    	$this->template = 'cadparceiro/cadfornecedor/index.phtml';
    	$this->div = '';
    	$this->primaryKey = null;
    	$this->searchFrase;
    	$this->searchDate;
    	$this->inner;
    	$this->campo = 'razao';
    	$this->idTable = 'fornecedor_id';
    	$this->colDataPesq = 'data_cadastro';
    	$this->whereCampo;
    	$this->colunas;
    	$this->order_by;
    	$this->group_by;
     }

    public function indexAction()
    {
        $this->div = $this->params('div');
        /*Construção dos campos a serem pesquizados*/
        if (strlen($this->params('search_frase')) > 0) {
            if (is_numeric($this->params('search_frase'))) {
                $this->searchFrase['fornecedor_id'] = $this->params('search_frase');
            }
            $this->searchFrase['razao'] = strtolower($this->params('search_frase'));
        }
        /*Aqui será enviado os valores para a pesquisa por data*/
        if (strlen($this->params('data_ini')) > 0 || strlen($this->params('data_fin')) > 0) {
            $this->searchDate['date_create'][] = $this->params('data_ini');
            $this->searchDate['date_create'][] = $this->params('data_fin');
        }
        
        /*Aqui será enviado uma array contendo os tabelas/ colunas e um array com a tabela que fara o inner e um array para exibir as colunas*/
        //$this->inner[] = array( 'inner'=> array("album" => 'genreid', "genre" => 'id',  "table" => 'genre', "join" => 'inner') , "columns" => array('genre'));
        
        $this->query = '';
        $divDados  = explode("_", $this->params('div'));
        //Verifica se a paginação, quando existe paginação o nome da div é dados_nome_aba 
        if($divDados[0] == 'dados'){
    	   $this->template = 'cadparceiro/cadfornecedor/dados.phtml';
        }else{
            $this->template = 'cadparceiro/cadfornecedor/index.phtml';
        }

    	return parent::indexAction();
    }

    public function editAction()
    {
        $this->div = $this->params('div');
        $this->route = 'cadparceiro/cadfornecedor/index';
        $this->template = 'cadparceiro/cadfornecedor/edit.phtml';
        return parent::editAction();
    }
    
    public function addAction()
    {
        $this->div = $this->params('div');
        $this->route = 'cadparceiro/cadfornecedor/index';
        $this->template = 'cadparceiro/cadfornecedor/add.phtml';
    	return parent::addAction();
    }
    
    public function deleteAction()
    {
       
        return parent::deleteAction();
    }
    
    public function prevAction()
    {
        $this->div = $this->params('div');
        $this->template = 'cadparceiro/cadfornecedor/edit.phtml';
         
        $this->queryPrev = "select prev
            from (
            select  fornecedor_id, razao, data_cadastro,
            lag(fornecedor_id) over (order by fornecedor_id asc) as prev,
            lead(fornecedor_id) over (order by fornecedor_id asc) as next
            from cad_fornecedor
            ) x
            where ? IN (fornecedor_id)";
    
    
        return parent::prevAction();
    }
    
    public function nextAction()
    {
        $this->div = $this->params('div');
        $this->template = 'cadparceiro/cadfornecedor/edit.phtml';
    
        $this->queryNext = "select next
            from (
             select  fornecedor_id, razao, data_cadastro,
            lag(fornecedor_id) over (order by fornecedor_id asc) as prev,
            lead(fornecedor_id) over (order by fornecedor_id asc) as next
            from cad_fornecedor
            ) x
            where ? IN (fornecedor_id)";
    
         
        return parent::nextAction();
    }
    
    public function gridAction()
    {
        return parent::gridAction();
    }
    
}
