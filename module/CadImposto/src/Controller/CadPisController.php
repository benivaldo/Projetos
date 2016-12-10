<?php

namespace CadImposto\Controller;

use Controle\Controller\AbstractCrudController;
use CadImposto\Form\CadPisForm;
use CadImposto\Model\CadPis;

class CadPisController extends AbstractCrudController
{
    protected $albumTable;
    
    public function getVariaveis()
    {
    	$this->tableGatewayClass = 'CadImposto\Model\CadPisTable';
    	$this->form = new CadPisForm();
    	$this->model = new CadPis();
    	$this->route = 'home';
    	$this->viewData = 'dados';
    	$this->pagination = true;
    	$this->template = 'cadpis/cadpis/index.phtml';
    	$this->div = '';
    	$this->primaryKey = null;
    	$this->searchFrase;
    	$this->searchDate;
    	$this->inner;
    	$this->campo = 'descricao';
    	$this->idTable = 'pis_id';
    	$this->colDataPesq = 'cad_grupo.data_cadastro';
    	$this->whereCampo;
    	$this->colunas;
    	$this->order_by;
    	$this->group_by;
     }

    public function indexAction()
    {
        $this->getVariaveis();
        
        $this->div = $this->params('div');
        /*Construção dos campos a serem pesquizados*/
        if (strlen($this->params('search_frase')) > 0) {
            if (is_numeric($this->params('search_frase'))) {
                $this->searchFrase['id'] = $this->params('search_frase');
            }
            $this->searchFrase['title'] = strtolower($this->params('search_frase'));
            $this->searchFrase['artist'] = strtolower($this->params('search_frase'));
            $this->searchFrase['genre'] = strtolower($this->params('search_frase'));
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
    	   $this->template = 'cadpis/cadpis/dados.phtml';
        }else{
            $this->template = 'cadpis/cadpis/index.phtml';
        }

    	return parent::indexAction();
    }

    public function editAction()
    {
        $this->getVariaveis();
        
        $this->div = $this->params('div');
        $this->route = 'cadpis/cadpis/index';
        $this->template = 'cadpis/cadpis/edit.phtml';
        return parent::editAction();
    }
    
    public function addAction()
    {
        $this->getVariaveis();
        
        $this->div = $this->params('div');
        $this->route = 'cadpis/cadpis/index';
        $this->template = 'cadpis/cadpis/add.phtml';
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
