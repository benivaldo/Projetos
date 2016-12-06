<?php

namespace CadImposto\Controller;

use Controle\Controller\AbstractCrudController;
use CadImposto\Form\CadIpiForm;
use CadImposto\Model\CadIpi;

class CadIpiController extends AbstractCrudController
{
    protected $albumTable;
    
    public function __construct()
    {
    	$this->tableGatewayClass = 'CadImposto\Model\CadIpiTable';
    	$this->form = new CadIpiForm();
    	$this->model = new CadIpi();
    	$this->route = 'home';
    	$this->viewData = 'dados';
    	$this->pagination = true;
    	$this->template = 'cadipi/cadipi/index.phtml';
    	$this->div = '';
    	$this->primaryKey = null;
    	$this->searchFrase;
    	$this->searchDate;
    	$this->inner;
    	$this->campo = 'descricao';
    	$this->idTable = 'ipi_id';
     }

    public function indexAction()
    {
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
    	   $this->template = 'cadipi/cadipi/dados.phtml';
        }else{
            $this->template = 'cadipi/cadipi/index.phtml';
        }

    	return parent::indexAction();
    }

    public function editAction()
    {
        $this->div = $this->params('div');
        $this->route = 'cadipi/cadipi/index';
        $this->template = 'cadipi/cadipi/edit.phtml';
        return parent::editAction();
    }
    
    public function addAction()
    {
        $this->div = $this->params('div');
        $this->route = 'cadipi/cadipi/index';
        $this->template = 'cadipi/cadipi/add.phtml';
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
