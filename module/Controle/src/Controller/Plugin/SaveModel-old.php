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
		    $form->setInputFilter($model->getInputFilter());
		    /*Remove itens do post*/
		    foreach ($removeFromPost as $name) {
                //$form->remove($name);
                $form->getInputFilter()->remove($name);
		    }

			$form->setData($request->getPost());
			if ($form->isValid()) {
			    
				$model->exchangeArray($form->getData());

				if (!$resp = $tableGateway->save($model)) {
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