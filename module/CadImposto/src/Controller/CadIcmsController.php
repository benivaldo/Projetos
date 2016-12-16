<?php

namespace CadImposto\Controller;

use Controle\Controller\AbstractCrudController;
use CadImposto\Form\CadIcmsForm;
use CadImposto\Model\CadIcms;

class CadIcmsController extends AbstractCrudController
{
    
    public function getVariaveis()
    {
    	$this->tableGatewayClass = 'CadImposto\Model\CadIcmsTable';
    	$this->form = new CadIcmsForm();
    	$this->model = new CadIcms();
    	$this->route = 'home';
    	$this->viewData = 'dados';
    	$this->pagination = true;
    	$this->template = 'cadimposto/cadicms/index.phtml';
    	$this->div = '';
    	$this->primaryKey = null;
    	$this->searchFrase;
    	$this->searchDate;
    	$this->inner;
    	$this->campo = 'descricao';
    	$this->idTable = 'icms_id';
    	$this->colDataPesq = 'data_cadastro';
    	$this->whereCampo;
    	$this->colunas;
    	$this->order_by = "icms_id";
    	$this->group_by;
     }

    public function indexAction()
    {
        $this->getVariaveis();
        
        $this->div = $this->params('div');
        /*Construção dos campos a serem pesquizados*/
        if (strlen($this->params('search_frase')) > 0) {
            if (is_numeric($this->params('search_frase'))) {
                $this->searchFrase['icms_id'] = $this->params('search_frase');
            }
            $this->searchFrase['cst'] = strtolower($this->params('search_frase'));
            $this->searchFrase['descricao'] = strtolower($this->params('search_frase'));
        }
        /*Aqui será enviado os valores para a pesquisa por data*/
        if (strlen($this->params('data_ini')) > 0 || strlen($this->params('data_fin')) > 0) {
            $this->searchDate[$this->colDataPesq][] = $this->params('data_ini');
            $this->searchDate[$this->colDataPesq][] = $this->params('data_fin');
        }
        
        /*Aqui será enviado uma array contendo os tabelas/ colunas e um array com a tabela que fara o inner e um array para exibir as colunas*/
        //$this->inner[] = array( 'inner'=> array("album" => 'genreid', "genre" => 'id',  "table" => 'genre', "join" => 'inner') , "columns" => array('genre'));
        
        $this->query = '';
        $divDados  = explode("_", $this->params('div'));
        //Verifica se a paginação, quando existe paginação o nome da div é dados_nome_aba 
        if($divDados[0] == 'dados'){
    	   $this->template = 'cadimposto/cadicms/dados.phtml';
        }else{
            $this->template = 'cadimposto/cadicms/index.phtml';
        }

    	return parent::indexAction();
    }

    public function editAction()
    {
        $this->getVariaveis();
        
        $this->div = $this->params('div');
        $this->route = 'cadimposto/cadicms/index';
        $this->template = 'cadimposto/cadicms/edit.phtml';
        return parent::editAction();
    }
    
    public function addAction()
    {
        $this->getVariaveis();
        
        $this->div = $this->params('div');
        $this->route = 'cadimposto/cadicms/index';
        $this->template = 'cadimposto/cadicms/add.phtml';
    	return parent::addAction();
    }
    
    public function deleteAction()
    {
        $this->getVariaveis();
        
        return parent::deleteAction();
    }
    
    public function prevAction()
    {
        $this->getVariaveis();
        $this->div = $this->params('div');
        $this->template = 'cadimposto/cadicms/edit.phtml';
         
        $this->queryPrev = "select prev
            from (
            select  icms_id, descricao, data_cadastro,
            lag(icms_id) over (order by icms_id asc) as prev,
            lead(icms_id) over (order by icms_id asc) as next
            from cad_icms
            ) x
            where ? IN (icms_id)";
    
    
        return parent::prevAction();
    }
    
    public function nextAction()
    {
        $this->getVariaveis();
        $this->div = $this->params('div');
        $this->template = 'cadimposto/cadicms/edit.phtml';
    
        $this->queryNext = "select next
            from (
            select  icms_id, descricao, data_cadastro,
            lag(icms_id) over (order by icms_id asc) as prev,
            lead(icms_id) over (order by icms_id asc) as next
            from cad_icms
            ) x
            where ? IN (icms_id);";
         
        return parent::nextAction();
    }
    
    
    public function gridAction()
    {
        return parent::gridAction();
    }
    
}
