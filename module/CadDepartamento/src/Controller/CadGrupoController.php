<?php

namespace CadDepartamento\Controller;

use Controle\Controller\AbstractCrudController;
use CadDepartamento\Model\CadGrupo;
use CadDepartamento\Form\CadGrupoForm;

class CadGrupoController extends AbstractCrudController
{
    protected $grupoTable;
    
    public function getVariaveis()
    {
    	$this->tableGatewayClass = 'CadDepartamento\Model\CadGrupoTable';
    	$this->form = new CadGrupoForm();
    	$this->model = new CadGrupo();
    	$this->route = 'home';
    	$this->viewData = 'dados';
    	$this->pagination = true;
    	$this->template = 'caddepartamento/cadgrupo/index.phtml';
    	$this->div = '';
    	$this->primaryKey = null;
    	$this->searchFrase;
    	$this->searchDate;
    	$this->inner;
    	$this->campo = 'descricao';
    	$this->idTable = 'grupo_id';
    	$this->colDataPesq = 'cad_grupo.data_cadastro';
    	$this->whereCampo;
    	$this->colunas;
    	$this->order_by = 'grupo_id';
    	$this->group_by;
    }

    public function indexAction()
    {
        $this->getVariaveis();
        
        $this->div = $this->params('div');
        /*Construção dos campos a serem pesquizados*/
        if (strlen($this->params('search_frase')) > 0) {
            if (is_numeric($this->params('search_frase'))) {
                $this->searchFrase['grupo_id'] = $this->params('search_frase');
            }
            $this->searchFrase['cad_grupo.descricao'] = strtolower($this->params('search_frase'));
            $this->searchFrase['cad_secao.descricao'] = strtolower($this->params('search_frase'));
        }
        /*Aqui será enviado os valores para a pesquisa por data*/
        if (strlen($this->params('data_ini')) > 0 || strlen($this->params('data_fin')) > 0) {
            $this->searchDate[$this->colDataPesq][] = $this->params('data_ini');
            $this->searchDate[$this->colDataPesq][] = $this->params('data_fin');
        }
        
        
        /*Aqui será enviado uma array contendo os tabelas/ colunas e um array com a tabela que fara o inner e um array para exibir as colunas*/
        $this->inner[] = array( 
            "table"     => 'cad_secao',
            "join"   => 'cad_grupo.secao_id = cad_secao.secao_id',
            "tipoJoin"      => 'inner',
            "columns" => array('secao' => 'descricao')      
        );
    
        
        $this->query = '';
        $divDados  = explode("_", $this->params('div'));
        //Verifica se a paginação, quando existe paginação o nome da div é dados_nome_aba 
        if($divDados[0] == 'dados'){
    	   $this->template = 'caddepartamento/cadgrupo/dados.phtml';
        }else{
            $this->template = 'caddepartamento/cadgrupo/index.phtml';
        }

    	return parent::indexAction();
    }

    public function editAction()
    {
        $this->getVariaveis();
        
        $this->div = $this->params('div');
        $this->template = 'caddepartamento/cadgrupo/edit.phtml';
        return parent::editAction();
    }
    
    public function addAction()
    {
        $this->getVariaveis();
        
        $this->div = $this->params('div');
        $this->template = 'caddepartamento/cadgrupo/add.phtml';
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
        $this->template = 'caddepartamento/cadgrupo/edit.phtml';
         
        $this->queryPrev = "select prev
            from (
            select  grupo_id, descricao, secao_id, data_cadastro,
            lag(grupo_id) over (order by grupo_id asc) as prev,
            lead(grupo_id) over (order by grupo_id asc) as next
            from cad_grupo
            ) x
            where ? IN (grupo_id);";
    
    
        return parent::prevAction();
    }
    
    public function nextAction()
    {
        $this->getVariaveis();
        
        $this->div = $this->params('div');
        $this->template = 'caddepartamento/cadgrupo/edit.phtml';
    
        $this->queryNext = "select next
            from (
            select  grupo_id, descricao, secao_id, data_cadastro,
            lag(grupo_id) over (order by grupo_id asc) as prev,
            lead(grupo_id) over (order by grupo_id asc) as next
            from cad_grupo
            ) x
            where ? IN (grupo_id);";
         
        return parent::nextAction();
    }
    
    public function gridAction()
    {
        $this->getVariaveis();
        return parent::gridAction();
    }
    
    public function getAction()
    {
        $this->getVariaveis();
        
        $this->colunas = array('id' => 'grupo_id', 'nome' => 'descricao' );
        $this->order_by = 'nome'; // Colocar o mesmo do campo da coluna caso seja usado o alias usar o nome do alias
        $this->group_by = array('id', 'nome');
        $this->whereCampo = array("secao_id = ".$this->params('id'));
        return parent::getAction();
    }
    
}
