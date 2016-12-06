<?php
namespace Controle\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

/**
 * Plugin para execução do metodo delete
 * @author jose.benivaldo
 *
 */
class DeleteModel extends AbstractPlugin
{
    /**
     * 
     * @param integer $key
     * @param object $tableGateway
     * @param string $route
     */
	public function delete($key, $tableGateway, $route = 'home')
	{
	    
		$request = $this->getController()->getRequest();
		
		if ($request->isPost()) {
		   	$del = $request->getPost('del', 'Nao');
            if ($del == 'Yes') {
                if (!$tableGateway->delete($key)) {
                    return array('id' => $key, 'erro' => 'Operação efetuada com sucesso');;
                } else {
                    return array('id' => $key, 'erro' =>'Erro na operação' );;
                }
            }
		
			return array('id' => $key, 'erro' => 'Nenhuma operação efetuada');;
		}		
	}
}