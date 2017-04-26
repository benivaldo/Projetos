<?php

namespace Controle\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Session\Container;
use Controle\Service\ControleService;
use Zend\Form\Annotation\Object;
use Sac\Entity\Chamados;

abstract class CommonCrudController extends AbstractActionController
{
    /**
     * Form em uso
     * @var Object
     */
	protected $form;
	
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
	 * Container
	 * @var Object
	 */
    protected $container;
	
    /**
     * Servico
     * @var Object
     */
	protected  $controleService;
	
	/**
	 * Entity manager.
	 * @var Doctrine\ORM\EntityManager
	 */
	protected  $entityManager;
	
	/**
	 * Caminho da entidade;
	 * @var PathExpression
	 */
	protected $entity;
	
	protected $model;
	
	public function __construct(ControleService $controleService)
	{
	    $this->controleService = $controleService;
	    $this->entityManager = $controleService->getEntity();
	    $this->container = $controleService->getContainer();	  
	}
	
	/**
	 * Verifica se a solicitação é ajax, caso seja retorna a resposta em Json,
	 * caso não seja retorna uma resposta normal
	 * @param unknown $viewModel
	 * @return \Zend\View\Model\JsonModel|array
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
	                'data' => $this->resultSet,
	                'info' =>  $this->info,
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
	 * Função para retorno de dados	 
	 * @param Object $query
	 * @return \Zend\View\Model\JsonModel|\Controle\Controller\array
	 */
	public function indexAction()	
	{
	    $orderBy = (null !== $this->params('order_by') ? $this->params('order_by') : $this->order_by);
	    $order = $this->params('order');
	    $search = $this->params('search_frase');
	    $page = $this->params('page');
	    $data_ini = $this->params()->fromRoute('data_ini', '');
	    $data_fin = $this->params()->fromRoute('data_fin', '');
	    
	    $query = $this->controleService->findAll($this->entity, $orderBy, $order, $search, $data_ini, $data_fin);
	    $paginator = $this->controleService->getPaginator($query, $page);	   
	    
	    $this->viewModel = new ViewModel(array (
	        $this->viewData => $paginator,
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
	
	/**
	 * Metodo para adicionar itens na tabela.
	 * @return \Zend\View\Model\ViewModel
	 */
	public function addAction()
	{
	    $entity = $this->container->get($this->entity);
	    $form = $this->form;
	    $this->form->bind($entity);
	    
	    $this->errorMessage = $this->saveModel()->save($entity, $this->controleService, $form, $this->route);
	
	   /* if ($this->infoAdic == true) {
	        $this->whereCampo = array($this->idTable => 0);
	        $this->colunas  = array($this->idTable);
	        $this->getAction();
	    }*/
	
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
	     
	    $id = (int) $this->params()->fromRoute('id', 0);
	     
	    //$key = '';
	    if (!$id) {
	        $this->redirect()->toRoute($this->route, array(
	            'action' => 'add'
	        ));
	    }
	    $entity =  $this->entityManager->find($this->entity, $id);

	     
	    $form  = $this->form;
	    $form->bind($entity);

	    $this->errorMessage = $this->saveModel()->save($entity, $this->controleService, $form, $this->route);
	
	   /* if ($this->infoAdic == true) {
	        $this->whereCampo = array($this->idTable => $key);
	        $this->colunas  = array($this->idTable);
	        $this->getAction();
	    }*/
	
	    $this->viewModel = new ViewModel(array ('form' => $form,
	        'div' => $this->div,
	        'info' => ($this->infoAdic == true ? $this->info->current(): []),
	    ));
	    return $this->verificaAjaxJson($this->viewModel);
	}
	/**
	 * Função para retornar o id anterior
	 */
	public function prevAction()
	{
	    $key = (int) $this->params()->fromRoute('id', 0);  
	    $params = array();
	    $params['id'] = $key;
	    $params['entity'] = $this->entity;
	    
	    $prevId =  $this->controleService->getPreviousData($params);
	
	    if (!empty($prevId[0]['id'])) {
	        $this->getEvent()->getRouteMatch()->setParam('id', $prevId[0]['id']);
	    }
	
	    return $this->editAction();
	}
	
	/**
	 * Função para retornar o id posterior
	 */
	public function nextAction()
	{
	    $key = (int) $this->params()->fromRoute('id', 0);
        $params = array();
	    $params['id'] = $key;
	    $params['entity'] = $this->entity;
	    
	    $nextId =  $this->controleService->getNextData($params);
	
	    if (!empty($nextId[0]['id'])) {
	        $this->getEvent()->getRouteMatch()->setParam('id', $nextId[0]['id']);
	    }
	
	    return $this->editAction();
	}
}