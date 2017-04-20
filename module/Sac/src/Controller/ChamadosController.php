<?php

namespace Sac\Controller;

use Zend\View\Model\ViewModel;

use Sac\Entity\Chamados;
use Sac\Entity\Clientes;
use Controle\Controller\CommonCrudController;

class ChamadosController extends CommonCrudController
{
    private function getVariaveis()
    {
		$this->form = $this->container->get('FormElementManager')->get('Sac\Form\ChamadosForm');
        $this->route = 'sac';
        $this->viewData = 'dados';
        $this->pagination = true;
        $this->template = 'sac/chamados/index.phtml';
        $this->div = '';
        $this->primaryKey = null;
        $this->order_by = 'id';
        $this->entity = '\Sac\Entity\Chamados';
        $this->searchFrase = '';
        $this->searchDate = '';
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
       return parent::indexAction();
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
        			$data = $form->getData();
        			$this->entityManager->persist($data);
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
