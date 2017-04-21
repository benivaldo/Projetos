<?php
namespace Controle\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

/**
 * Plugin para execução do metodo save
 * @author jose.benivaldo
 *
 */
class SaveModel extends AbstractPlugin
{
    /**
     * 
     * @param object $model
     * @param object $tableGateway
     * @param object $form
     * @param string $route
     */
	public function save($entity, $controleService, $form, $route = 'home')
	{
	    $erro = '';
		$request = $this->getController()->getRequest();
		
		if ($request->getPost()->offsetExists('id')) {
		    $id = $request->getPost('id');
		    if ((int) $id == 0) {
                $request->getPost()->offsetUnset('id');
		    }
		}
		
		if ($request->isPost() && count($request->getPost()) != 0) {		    
		    $form->setInputFilter($entity->getInputFilter());
        	$form->setData($request->getPost()); 

			if ($form->isValid()) {			    
				$data = $form->getData();
				if (!$resp = $controleService->save($entity, $data)) {
				    return $resp;
				} else {
				    return $resp;
				}
			} else {	
			    foreach ($form->getMessages() as $key => $campo) {
    			    foreach ($campo as $key1 => $value) {
    			    	$erro .= "Campo $key: $value \n";
    			    }
			    }
			   return  array('id' => '', 'erro' => $erro);
			}
		}		
	}
}