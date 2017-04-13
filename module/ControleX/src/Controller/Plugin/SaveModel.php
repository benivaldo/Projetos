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
	public function save($model, $tableGateway, $form, $route = 'home', $removeFromPost = array())
	{
	    $erro = '';
		$request = $this->getController()->getRequest();
		
		if ($request->isPost() && count($request->getPost()) != 0) {		    
		    /*Remove itens do post*/
		    foreach ($removeFromPost as $name) {
                $model->getInputFilter()->remove($name);
                $request->getPost()->offsetUnset($name);
		    }
		    //print_r($request->getPost());
		    $valid = $model->getInputFilter()->setData($request->getPost());

			if ($valid->isValid()) {			    
				$model->exchangeArray($request->getPost());

				if (!$resp = $tableGateway->save($model)) {
				    return $resp;
				} else {
				    return $resp;
				}
			} else {	
			    foreach ($valid->getMessages() as $key => $campo) {
    			    foreach ($campo as $key1 => $value) {
    			    	$erro .= "Campo $key: $value \n";
    			    }
			    }
			   return  array('id' => '', 'erro' => $erro);
			}
		}		
	}
}