<?php
namespace Sac\Entity;

use Doctrine\ORM\Event\PreFlushEventArgs as Event;
use Sac\Entity\Chamados;

class ChamadosListener
{
	protected $container;
	
   public function __construct($container)
	{
		$this->container = $container;
	}
		
	public function preFlush(Chamados $chamados, Event $event)
	{
        echo '222222';
	}
}