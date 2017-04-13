<?php

namespace Controle\Controller;

use Controle\Controller\CommonCrudController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Session\Container;
use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\ArrayUtils;

class AbstractCrudController extends CommonCrudController
{
	private  $tableGateway;

	/**
	 * @var string Nome da classe do tableGateway
	 */
	protected $tableGatewayClass;
	/**
	 * @var Zend\Form Instância do formulário
	 */
	protected $form;
	/**
	 * @var Acme\Model\AbstractModel Modelo a ser manipulado
	 */
	protected $model;
	/**
	 * @var string Nome da rota a ser redicionada
	 */
	protected $route;
	/**
	 * @var string Nome da variável de dados da view 
	 */
	protected $viewData;
	
	/**
	 * 
	 * @var string Nome do template usado na view 
	 */
	protected $template;
	
	/*
	 * @var string nome usado na div de counteudo Tab
	 */
	protected $div;
	
	/**
	 * @var boolean Se usa paginador na index
	 */
	protected $pagination = false;
	
	/**
	 * 
	 * @var string nome do campo chave primária
	 */
	protected $primaryKey;
	
	/**
	 * 
	 * @var string nome da coluna da tabela em uso
	 */
	protected $campo;
	
	/**
	 * 
	 * @var string dados para pesquisa
	 */
	protected $searchFrase = array();
	
	/**
	 *
	 * @var array string dados para pesquisa por data
	 */
	protected $searchDate = array();
	
	/**
	 * 
	 * @var string nome da chave primaria da tabela em uso
	 */
	protected $idTable;
	
	/**
	 * 
	 * @var string variável de sessão
	 */
	protected $sessionNav;
	
	/**
	 * 
	 * @var array campos para inner
	 */
	protected $inner = array();
	
	/*
	 * @var string query a ser consultada
	 */
	protected $query;
	
	/*
	 * @var string query a retornar o id anterior
	 */
	protected $queryPrev;
	
	/*
	 * @var string query a retornar o id posterior
	 */
	protected $queryNext;
	
	/**
	 * Nome da coluna a ser pesquisada em tabela especifica
	 * @var string
	 */
	protected $colDataPesq;
	
	/**
	 * colunas para pesquisa na função fechAll
	 * @var array
	 */
	protected $whereCampo = array();
	
	/**
	 * Colunas a serem exibidas na query principal
	 * @var array
	 */
	protected $colunas = array();
	
	/**
	 * Nome da coluna a ser ordenada
	 * @var string
	 */
	protected $order_by;
	
	/**
	 * Colunas a serem agrupadas
	 * @var array
	 */
	protected $group_by = array();
	
	/**
	 * 
	 * @var string nome do template a ser renderizado
	 */
	private $viewModel;
	
	/**
	 * 
	 * @var string mensagem de erro e retrono do id
	 */
	protected  $errorMessage = array('id' => '','erro' => '');
	
	
	/**
	 * 
	 * @var array Remove variaves do post
	 */
	protected $removeFromPost = array();
	
	/**
	 * Array com retorno dem dados de consulta a ser retornado no jsaon
	 * @var array
	 */
	protected $resultSet = array();
	
	/**
	 * Array com informações adicionais
	 * @var array
	 */
	protected $info = array();
	
	/**
	 * Informações adicionais do retorno de edição ou qualquer outra função que necessite
	 * @var bollean
	 */
	protected  $infoAdic = false;
   

	/**
	 * Esse método retorna o tablegateway em uso
	 * @return Ambigous <object, multitype:>
	 */
	public function getTableGateway()
	{
	    if (!$this->tableGateway) {
            $this->tableGateway = $this->container->get($this->tableGatewayClass);
        }
        return $this->tableGateway;
	}
	
	/*
	 * Função para renderizações de views
	 */
	public function indexAction()
    {
        $this->resultSet = $this->getTableGateway()->fetchAll(
            $this->pagination, 
            $this->params('page'), 
            (null !== $this->params('total_page') ? $this->params('total_page') : 10),
            (null !== $this->params('order_by') ? $this->params('order_by') : $this->order_by), 
            $this->params('order'), 
            $this->searchFrase, 
            $this->searchDate, 
            $this->inner, 
            $this->query,                   
            $this->colDataPesq,
            $this->colunas,
            $this->whereCampo,
            $this->group_by
        ); 
        
        $this->viewModel = new ViewModel(array (
            $this->viewData => $this->resultSet,
            'div' => str_replace('dados_', '', $this->div), //Retira dados_ pra evitar duplicidade, necessario para ordenação
            'order_by' =>(null !== $this->params('order_by') ? $this->params('order_by') : $this->order_by),
            'order' => $this->params('order'),
            'search_frase' => $this->params('search_frase'),
            'data_ini' => $this->params('data_ini'),
            'data_fin' => $this->params('data_fin'),
            'page' => $this->params('page'),
            'tipo_view' =>(null !== $this->params('tipo_view') ? $this->params('tipo_view') : false),
        ));
 
        return $this->verificaAjaxJson($this->viewModel);
       
    }
    
    /*
     * Função retorno do grid
     */
    public function gridAction()
    {
       $result = $this->getTableGateway()->fetchAll($this->pagination ,$this->params()->fromPost('current'), $this->params()->fromPost('rowCount'), $this->query);

        return new JsonModel(array(
			'current' => $this->params()->fromPost('current'),
			'rowConunt' => $this->params()->fromPost('rowCount'),
	        'rows' =>  iterator_to_array($result),
            'total' => $result->getTotalItemCount()
    	));
}
    
   /**
   * Verifica se a solicitação é ajax, caso seja retorna a resposta em Json,
   * caso não seja retorna uma resposta normal
   * @param unknown $viewModel
   * @return \Zend\View\Model\JsonModel|unknown
   */
    public function verificaAjaxJson($viewModel)
    {        
        $viewModel->setTemplate($this->template); // caminho para o template que será renderizado
               
        $request = $this->getRequest();
        $response = $this->getResponse();
        
        if ($request->isXmlHttpRequest()) {
        	if ($request->isPost()) {
        		$viewModel->setTerminal(true); // desabilita a renderização do layout
        		$html = $this->container->get('ViewRenderer')->render($viewModel);
        		
        		$result = new JsonModel(array(
    				'html' => $html,
        		    'data' => \Zend\Stdlib\ArrayUtils::iteratorToArray($this->resultSet),
        		    'info' =>  \Zend\Stdlib\ArrayUtils::iteratorToArray( $this->info),
    				'success' => true,
    		        'errorMessage' => $this->errorMessage['erro'],
        		    'id' => $this->errorMessage['id'],
        		));
        	}
        	return $result;
        } else {
        	return  $viewModel;
        }         
    }

     
    /**
     * Metodo para adicionar itens na tabela.
     * @return \Zend\View\Model\ViewModel
     */
    public function addAction()
    {
        $form = $this->form;
        $form->get('submit')->setValue('Incluir');

        $this->errorMessage = $this->saveModel()->save($this->model, $this->getTableGateway(), $form, $this->route, $this->removeFromPost);
        
        if ($this->infoAdic == true) {
            $this->whereCampo = array($this->idTable => 0);
            $this->colunas  = array($this->idTable);
            $this->getAction();
        }
        
        $this->viewModel = new ViewModel(array ('form' => $form,
            'info' => $this->info,
            'div' => $this->div,
        ));
        return $this->verificaAjaxJson($this->viewModel);
    }
    
    /**
    * Metodo para alterar itens na tabela.
    * @return Ambigous <\Zend\Http\Response, \Zend\Stdlib\ResponseInterface>|\Zend\View\Model\ViewModel
    */
    public function editAction()
    {    
        $request = $this->getRequest();
       
        $key = (int) $this->params()->fromRoute('id', 0);
       
        //$key = '';
        if (!$key) {          
            $this->redirect()->toRoute($this->route, array(
                'action' => 'add'
            ));
        }
        $model = $this->getTableGateway()->get($key);
        $this->resultSet[] =  new \ArrayIterator($model);
         
        $form  = $this->form;
        $form->bind($model);
        
        $form->get('submit')->setAttribute('value', 'Editar');        
        $this->errorMessage = $this->saveModel()->save($model, $this->tableGateway, $form, $this->route, $this->removeFromPost);
 
        if ($this->infoAdic == true) {
            $this->whereCampo = array($this->idTable => $key);
            $this->colunas  = array($this->idTable);
            $this->getAction();
        }
        
        $this->viewModel = new ViewModel(array ('form' => $form,
            'div' => $this->div,
            'info' => ($this->infoAdic == true ? $this->info->current(): []),
        ));
        return $this->verificaAjaxJson($this->viewModel);
    }    
    
    /**
     * Metodo para exclusão de dados na tabela
     * @return Ambigous <\Zend\Http\Response, \Zend\Stdlib\ResponseInterface>|multitype:NULL
     */
    public function deleteAction()
    {
        $this->getTableGateway(); //Retorna Tablegateway
        
        $request = $this->getRequest();

        $key = (int)$this->params('id');
        
        
        if (!$key) {
            if ($request->isXmlHttpRequest()) {
                return $result = new JsonModel(array(
    				'html' => '',
    				'success' => true,
    		        'errorMessage' => 'Erro na operação',
            	));
            } else {
                return $this->redirect()->toRoute($this->route);
            }
           
        }
        
        $this->errorMessage = $this->deleteModel()->delete($key, $this->tableGateway, $this->route);
        
        if ($request->isXmlHttpRequest()) {
            return $result = new JsonModel(array(
				'html' => '',
				'success' => true,
		        'errorMessage' => $this->errorMessage['erro'],
        		'id' => $this->errorMessage['id'],
    		));
        } else {
            return array(
                'id' => $key,
                 $this->viewData => $this->getTableGateway()->get($key)
            );
        }
    }
    
    /**
     *  Essa função set o client encoding postgres para UTF8
     */
    private function setToUTF8()
    {
        $query = 'set client_encoding to UTF8';
        $statement = $this->container->get('Zend\Db\Adapter\Adapter')->query($query);
        $statement->execute();
    }
    
    public function getSessionNav()
    {
    	$this->sessionNav = new Container('nav');
    	return $this->sessionNav;
    }
    
    public function setSessionNav($sessionNav)
    {
    	$this->sessionNav = $sessionNav;
    }
    
    /**
     * Função para retornar o id anterior
     */
    public function prevAction()
    {
        $key = (int) $this->params()->fromRoute('id', 0);
        
        $query = $this->queryPrev;
        
        $statement = $this->container->get('Zend\Db\Adapter\Adapter')->createStatement($query, array($key));
        $result = $statement->execute();
        $row = $result->current();

        if (!empty($row['prev'])) {
            $this->getEvent()->getRouteMatch()->setParam('id', $row['prev']);
        }
    
        return self::editAction();
    }
    
    /**
     * Função para retornar o id posterior
     */
    public function nextAction()
    {
        $key = (int) $this->params()->fromRoute('id', 0);
    
        $query = $this->queryNext;
    
        $statement = $this->container->get('Zend\Db\Adapter\Adapter')->createStatement($query, array($key));
        $result = $statement->execute();
        $row = $result->current();
    
        if (!empty($row['next'])) {
            $this->getEvent()->getRouteMatch()->setParam('id', $row['next']);
        }
    
        return self::editAction();
    }
    
    /**
     * Função para retornar items de uma table em uso
     */
    public function getAction()
    {
        //$this->whereCampo = ($this->params('id') != 0 ? $this->whereCampo : array());
        
        $result = $this->getTableGateway()->fetchAll(
            false,
            $this->params('page'),
            $this->params('total_page'),
            $this->order_by,
            'ASC',
            $this->searchFrase,
            $this->searchDate,
            $this->inner,
            $this->query,
            $this->colDataPesq,
            $this->colunas,
            $this->whereCampo,
            $this->group_by
        );
        
        if ($this->infoAdic == true) {
            return $this->info =  $result;
        } else {
            return  new JsonModel(array(
        				'dados' => \Zend\Stdlib\ArrayUtils::iteratorToArray($result),
        				'success' => true,
        		        'errorMessage' => '',
                		'name' => $this->params()->fromPost('name'),
                        'form' => $this->params()->fromPost('form'),
                    ));
        }
    }
}