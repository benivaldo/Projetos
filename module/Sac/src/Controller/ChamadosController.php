<?php

namespace Sac\Controller;

// Add aliases for paginator classes
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Sac\Entity\Chamados;
use Sac\Entity\Clientes;

class ChamadosController extends AbstractActionController
{
	/**
	 * Resultado da pesquisa
	 * @var Array
	 */
	private $resultSet;
	
	private $viewModel;
	
	private $viewData;
	
	private $pagination;
	
	private $template;
	
	private $order_by;
	
	private $container;
	
	private $info;
	
	private $errorMessage;
	
	private $form;
	

	/**
	 * Entity manager.
	 * @var Doctrine\ORM\EntityManager
	 */
	private $entityManager;
	
	// Constructor method is used to inject dependencies to the controller.
	public function __construct($entityManager, $container)
	{
		$this->entityManager = $entityManager;
		$this->container = $container;
		$this->form = $this->container->get('FormElementManager')->get('Sac\Form\ChamadosForm');
		//$this->form = $form;
	}
	  
     private function getVariaveis()
    {
        //$this->form = new ChamadosForm();
        $this->route = 'sac';
        $this->viewData = 'dados';
        $this->pagination = true;
        $this->template = 'sac/chamados/index.phtml';
        $this->div = '';
        $this->primaryKey = null;
        $this->order_by = 'id';
    }
    
    public function indexAction()
    {
        $this->getVariaveis();
        
        $this->div = $this->params('div');

        $divDados  = explode("_", $this->params('div'));
        
        //Verifica se a paginação, quando existe paginação o nome da div é dados_nome_aba 
        if($divDados[0] == 'dados'){
    	   $this->template = 'sac/chamados/dados.phtml';
        }else{
            $this->template = $this->template;
        }
        
        $orderBy = (null !== $this->params('order_by') ? $this->params('order_by') : $this->order_by);
        $order = $this->params('order');
        $search = $this->params('search_frase');
           
        $query = $this->entityManager->getRepository(Chamados::class)->findChamados($orderBy, $order, $search);
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

    public function editAction()
    {
        $this->getVariaveis();        
      
        $erro = "";
        $this->div = $this->params('div');
        $this->template = 'sac/chamados/edit.phtml';
       
        $id = (int) $this->params()->fromRoute('id', 0);
       
        $chamados = $this->entityManager->find('Sac\Entity\Chamados', $id);
        
        $form  = $this->form;
        $form->bind($chamados);
        
        $form->get('submit')->setAttribute('value', 'Editar'); 
        $request = $this->getRequest();
        
    	if ($request->isPost() && count($request->getPost()) != 0) {        	
        	$form->setInputFilter($chamados->getInputFilter());
        	$form->setData($request->getPost());        	
        	if ($form->isValid()) {        		
        		try {
        			$form->bindValues();
	        		$this->entityManager->flush();
	        		$id = $chamados->getId(); 
	        		$erro = "Operação concluida com sucesso.";
        		} catch (\Exception $e) {
			        $erro =  $e->getMessage();
			    }finally {
	               $this->errorMessage['id'] = '';
	            }
        	}else {	
		 	   	foreach ($form->getMessages() as $key => $campo) {
	    	   		foreach ($campo as $key1 => $value) {
	    				$erro .= "Campo $key: $value \n";
	    			}
				}			   
			}
        }
 
        $this->errorMessage['erro'] = $erro;
        $this->errorMessage['id'] = $id;
               
        $this->viewModel = new ViewModel(array ('form' => $form,
            'div' => $this->div,
            'info' => "",
        ));
        return $this->verificaAjaxJson($this->viewModel);
        
    }
    
    public function addAction()
    {
        $this->getVariaveis();
        $chamados = new Chamados();
        $erro = "";
        $log = "";
        $id = "";
        $this->div = $this->params('div');
        $this->template = 'sac/chamados/add.phtml';
        
       	$form  = $this->form;
        $request = $this->getRequest();
        
        if ($request->isPost() && count($request->getPost()) != 0) {  
            //Verifica se o número do pedido existe
            $idPedido = (int) $this->params()->fromPost('pedidos');
            $pedidos = $this->entityManager->find('Sac\Entity\Pedidos', $idPedido); 
            
            if(count($pedidos) > 0) {
            	$form->setInputFilter($chamados->getInputFilter());
            	$form->setData($request->getPost());
            	$email = $this->params()->fromPost('email');
            	$nome = $this->params()->fromPost('clientes');
            	$clientes = $this->validaEmail($email, $nome);
            	
            	if ($form->isValid()) {             	    
            		$chamados->setClientes($clientes);
            		$chamados->setEmail($clientes->getEmail());
            		$chamados->setPedidos($pedidos);
            		$chamados->setTitulo($this->params()->fromPost('titulo'));
            		$chamados->setObservacao($this->params()->fromPost('observacao'));
            		try {
            			$this->entityManager->persist($chamados);
    	        		$this->entityManager->flush();
    	        		$id = $chamados->getId(); 
    	        		$erro = "Operação concluida com sucesso.";
            		} catch (\Exception $e) {
    			        $erro =  $e->getMessage();
    			    }finally {
    	               $this->errorMessage['id'] = '';
    	            }
            	}else {	
    		 	   	foreach ($form->getMessages() as $key => $campo) {
    	    	   		foreach ($campo as $key1 => $value) {
    	    				$erro .= "Campo $key: $value \n";
    	    			}
    				}			   
    			}
            } else {
                $erro = "Número do pedido inexistente.";
            }
        }
        
		$this->errorMessage['erro'] = $erro;
		$this->errorMessage['id'] = $id;
        $form->prepare();
        
        $this->viewModel = new ViewModel(array ('form' => $form,
            'info' => $this->info,
            'div' => $this->div,
        ));
        return $this->verificaAjaxJson($this->viewModel);
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
    
    private function validaEmail($email, $nome)
    {
        $clientes = new Clientes();        
        $result = $this->entityManager->getRepository("Sac\Entity\Clientes")->findBy(array("email" => $email));

        if (count($result) > 0) {
            return $result[0];
        } else {
            $clientes->setNome($nome);
            $clientes->setEmail($email);
            $this->entityManager->persist($clientes);
            $this->entityManager->flush();
           return $clientes; 
        }
    }
}
