<?php

namespace CadImposto\Controller;

use Controle\Controller\AbstractCrudController;
use CadImposto\Form\CadNcmForm;
use CadImposto\Model\CadNcm;

class CadNcmController extends AbstractCrudController
{
    protected $albumTable;
    
    public function getVariaveis()
    {
    	$this->tableGatewayClass = 'CadImposto\Model\CadNcmTable';
    	$this->form = new CadNcmForm();
    	$this->model = new CadNcm();
    	$this->route = 'home';
    	$this->viewData = 'dados';
    	$this->pagination = true;
    	$this->template = 'cadncm/index.phtml';
    	$this->div = '';
    	$this->primaryKey = null;
    	$this->searchFrase;
    	$this->searchDate;
    	$this->inner;
    	$this->campo = 'descricao';
    	$this->idTable = 'ncm_id';
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
            $this->searchFrase['codigo'] = strtolower($this->params('search_frase'));
            $this->searchFrase['descricao'] = strtolower($this->params('search_frase'));
        }
        /*Aqui será enviado os valores para a pesquisa por data*/
        if (strlen($this->params('data_ini')) > 0 || strlen($this->params('data_fin')) > 0) {
            $this->searchDate['data_cadastro'][] = $this->params('data_ini');
            $this->searchDate['date_cadastro'][] = $this->params('data_fin');
        }
        
        /*Aqui será enviado uma array contendo os tabelas/ colunas e um array com a tabela que fara o inner e um array para exibir as colunas*/
        //$this->inner[] = array( 'inner'=> array("album" => 'genreid', "genre" => 'id',  "table" => 'genre', "join" => 'inner') , "columns" => array('genre'));
        
        $this->query = '';
        $divDados  = explode("_", $this->params('div'));
        //Verifica se a paginação, quando existe paginação o nome da div é dados_nome_aba 
        if($divDados[0] == 'dados'){
    	   $this->template = 'cadncm/dados.phtml';
        }else{
            $this->template = 'cadncm/index.phtml';
        }

    	return parent::indexAction();
    }

    public function editAction()
    {
        $this->getVariaveis();
        
        $this->div = $this->params('div');
        $this->route = 'cadncm/cadncm/index';
        $this->template = 'cadncm/cadncm/edit.phtml';
        return parent::editAction();
    }
    
    public function addAction()
    {
        $this->getVariaveis();
        $this->div = $this->params('div');
        $this->route = 'cadncm/cadncm/index';
        $this->template = 'cadncm/cadncm/add.phtml';
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
