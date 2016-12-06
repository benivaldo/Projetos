<?php

namespace CadProduto\Controller;

use Controle\Controller\AbstractCrudController;
use CadProduto\Model\CadProduto;
use CadProduto\Form\CadProdutoForm;

class CadProdutoController extends AbstractCrudController
{
    protected $albumTable;
    
    public function __construct()
    {
    	$this->tableGatewayClass = 'CadProduto\Model\CadProdutoTable';
    	$this->form = new CadProdutoForm();
    	$this->model = new CadProduto();
    	$this->route = 'home';
    	$this->viewData = 'dados';
    	$this->pagination = true;
    	$this->template = 'cadproduto/index.phtml';
    	$this->div = '';
    	$this->primaryKey = null;
    	$this->searchFrase;
    	$this->searchDate;
    	$this->inner;
    	$this->campo = 'descricao';
    	$this->idTable = 'produto_id';
     }

    public function indexAction()
    {
        $this->div = $this->params('div');
        /*Construção dos campos a serem pesquizados*/
        if (strlen($this->params('search_frase')) > 0) {
            if (is_numeric($this->params('search_frase'))) {
                $this->searchFrase['id'] = $this->params('search_frase');
            }
            $this->searchFrase['descricao'] = strtolower($this->params('search_frase'));
            $this->searchFrase['desc_resumida'] = strtolower($this->params('search_frase'));
            //$this->searchFrase['sku'] = strtolower($this->params('search_frase'));
        }
        /*Aqui será enviado os valores para a pesquisa por data*/
        if (strlen($this->params('data_ini')) > 0 || strlen($this->params('data_fin')) > 0) {
            $this->searchDate['date_cadastro'][] = $this->params('data_ini');
            $this->searchDate['date_cadastro'][] = $this->params('data_fin');
        }
        
        /*Aqui será enviado uma array contendo os tabelas/ colunas e um array com a tabela que fara o inner e um array para exibir as colunas*/
       // $this->inner[] = array( 'inner'=> array("produto" => 'plu', "sku" => 'plu',  "table" => 'sku', "join" => 'inner') , "columns" => array('sku'));
        
        $this->query = '';
        $divDados  = explode("_", $this->params('div'));
        //Verifica se a paginação, quando existe paginação o nome da div é dados_nome_aba 
        if($divDados[0] == 'dados'){
    	   $this->template = 'cadproduto/dados.phtml';
        }else{
            $this->template = 'cadproduto/index.phtml';
        }

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
