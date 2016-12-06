<?php
namespace Controle\Authentication;

use Zend\Authentication\AuthenticationService;

use Zend\EventManager\Event;

class Router
{
	public function verify(Event $event)
	{
		$application = $event->getTarget();
		
		$url = $application->getRequest()
		->getRequestUri();
		
		$baseUrl = $application->getRequest()->
		getBaseUrl();
		
		$route = str_replace($baseUrl,'',$url);
		
		if ($route == '/' || strpos($route,'application')!== false)
			return;
				
		$authentication = new AuthenticationService();
		if ($authentication->hasIdentity())
		{
			$usuario = $authentication
			->getIdentity();
			
			$acl = $_SESSION['acl'];			
			
			if ($acl->hasResource(substr($route,1))
				&&
				$acl->isAllowed(
					$usuario->papel,
					substr($route,1)))
			{	
				return;
			}		
			$this->changeRoute($application, 'menu');
		} 
		$this->changeRoute($application,'index');		
	}
	
	private function changeRoute($application, $action)
	{
		$router = $application->getServiceManager()
		->get('Router');
		
		$url = $router->assemble(
				array(
						'controller'=> 'index',
						'action'=>$action
				),
				array(
						'name'=> 'application'
				)
		);
			
		$response = $application->getResponse();
		$response->setHeaders($response->getHeaders()
				->addHeaderLine('Location',$url));
		$response->setStatusCode(302);
		$response->sendHeaders();
		exit;		
	}
	
	
	
	
	
	
}