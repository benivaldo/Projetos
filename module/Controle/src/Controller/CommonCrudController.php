<?php

namespace Controle\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Session\Container;
use Zend\Stdlib\ArrayUtils;
use Controle\Service\ControleService;
use Zend\Form\Annotation\Object;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;
use Doctrine\ORM\Query\AST\PathExpression;

abstract class CommonCrudController extends AbstractActionController
{
	private  $tableGateway;

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
	
	public function __construct(ControleService $controleService)
	{
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
	 * Função para retorno de paginação
	 * Criar uma uma função findAllData em todos reposistórios da entidade
	 * @param Object $query
	 * @return \Zend\View\Model\JsonModel|\Controle\Controller\array
	 */
	public function indexAction()	
	{
	    $orderBy = (null !== $this->params('order_by') ? $this->params('order_by') : $this->order_by);
	    $order = $this->params('order');
	    $search = $this->params('search_frase');
	    
	    $query = $this->entityManager->getRepository($this->entity)->findAllData($orderBy, $order, $search);
	    
	    $query->setHydrationMode(\Doctrine\ORM\Query::HYDRATE_SCALAR);
	    
	    $page = $this->params('page');
	    $adapter = new DoctrineAdapter(new ORMPaginator($query, false));
	    $paginator = new Paginator($adapter);
	    $paginator->setDefaultItemCountPerPage(5);
	    $paginator->setCurrentPageNumber($page);
	    
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
}