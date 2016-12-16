<?php

namespace CadDepartamento\Controller;

use CadDepartamento\Form\CadSecaoForm;
use CadDepartamento\Model\CadSecao;
use Controle\Controller\AbstractCrudController;


class CadSecaoController extends AbstractCrudController
{
    protected $albumTable;
    
     private function getVariaveis()
    {
        $this->tableGatewayClass = 'CadDepartamento\Model\CadSecaoTable';
        $this->form = new CadSecaoForm();
        $this->model = new CadSecao();
        $this->route = 'caddepartamento';
        $this->viewData = 'dados';
        $this->pagination = true;
        $this->template = 'caddepartamento/cadsecao/index.phtml';
        $this->div = '';
        $this->primaryKey = null;
        $this->searchFrase;
        $this->searchDate;
        $this->inner;
        $this->campo = 'descricao';
        $this->idTable = 'secao_id';
        $this->colDataPesq = 'data_cadastro';
        $this->whereCampo;
        $this->colunas;
        $this->order_by = 'secao_id';
        $this->group_by;
    }
    
    public function indexAction()
    {
        $this->getVariaveis();
        
        $this->div = $this->params('div');
        
        /*Construção dos campos a serem pesquizados*/
        if (strlen($this->params('search_frase')) > 0) {
            if (is_numeric($this->params('search_frase'))) {
                $this->searchFrase['secao_id'] = $this->params('search_frase');
            }
            $this->searchFrase['descricao'] = strtolower($this->params('search_frase'));
        }
        
        /*Aqui será enviado os valores para a pesquisa por data*/
        if (strlen($this->params('data_ini')) > 0 || strlen($this->params('data_fin')) > 0) {
            $this->searchDate[$this->colDataPesq][] = $this->params('data_ini');
            $this->searchDate[$this->colDataPesq][] = $this->params('data_fin');
        }
        
        /*Aqui será enviado uma array contendo os tabelas/ colunas e um array com a tabela que fara o inner e um array para exibir as colunas*/
         /*$this->inner[] = array( 
            "table"     => 'cad_secao',
            "join"   => 'cad_grupo.secao_id = cad_secao.secao_id',
            "tipoJoin"      => 'inner',
            "columns" => array('secao' => 'descricao')      
        );*/
        
        $this->query = '';
        $divDados  = explode("_", $this->params('div'));
        
        //Verifica se a paginação, quando existe paginação o nome da div é dados_nome_aba 
        if($divDados[0] == 'dados'){
    	   $this->template = 'caddepartamento/cadsecao/dados.phtml';
        }else{
            $this->template = $this->template;
        }

    	return parent::indexAction();
    }

    public function editAction()
    {
        $this->getVariaveis();
        
        $this->div = $this->params('div');
        $this->template = 'caddepartamento/cadsecao/edit.phtml';
        return parent::editAction();
    }
    
    public function addAction()
    {
        $this->getVariaveis();
        
        $this->div = $this->params('div');
        $this->template = 'caddepartamento/cadsecao/add.phtml';
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
        $this->template = 'caddepartamento/cadsecao/edit.phtml';
         
        $this->queryPrev = "select prev
            from (
            select  secao_id, descricao, data_cadastro,
            lag(secao_id) over (order by secao_id asc) as prev,
            lead(secao_id) over (order by secao_id asc) as next
            from cad_secao
            ) x
            where ? IN (secao_id)";
 
    
        return parent::prevAction();
    }
    
    public function nextAction()
    {
        $this->getVariaveis();
        $this->div = $this->params('div');
        $this->template = 'caddepartamento/cadsecao/edit.phtml';
        
        $this->queryNext = "select next
            from (
            select  secao_id, descricao, data_cadastro,
            lag(secao_id) over (order by secao_id asc) as prev,
            lead(secao_id) over (order by secao_id asc) as next
            from cad_secao
            ) x
            where ? IN (secao_id);";
   
        return parent::nextAction();
    }
    
       
    public function gridAction()
    {
        return parent::gridAction();
    }
    
}
