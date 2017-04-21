<?php
namespace Sac\Form;


use Zend\Form\Form;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sac\Entity\Pedidos;
use Sac\Entity\Clientes;
use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class ChamadosForm extends Form implements ObjectManagerAwareInterface
{
  	protected $objectManager;
    protected $entityManager;
    
    public function __construct(EntityManager $entityManager)
    {
 
        $this->entityManager = $entityManager;       
        
    }
    
    public function init()
    {
    	parent::__construct('form');
    	$this->setHydrator(new DoctrineHydrator($this->entityManager));
    	
    	$this->setAttribute('method', 'post');
        
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                    'type'  => 'text',
                    'class' => 'form-control input-sm',
                    'placeholder' =>'Chamado',
                    'readonly'  => 'readonly',
            ),
        ));
        
        $this->add([
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'pedidos',
        	'attributes' => array(
        			'class' => 'form-control input-sm',
        			'placeholder' =>'Número do pedido',
        	),
            'options' => [
                'object_manager' => $this->getObjectManager(),
                'target_class'   => Pedidos::class,
                'property'       => 'id',
        		'disable_inarray_validator' => true
            ],
        ]);
        

        $this->add(array(
                'name' => 'clientes',
        		'type' => 'DoctrineModule\Form\Element\ObjectSelect',
                'attributes' => array(
                    'class' => 'form-control input-sm',
                    'placeholder' =>'Nome do cliente',
            ),
        		'options' => [
        		'object_manager' => $this->getObjectManager(),
        		'target_class'   => Clientes::class,
        		'property'       => 'nome',
        		'disable_inarray_validator' => true
        		],
        ));
        
        $this->add(array(
        		'name' => 'titulo',
        		'attributes' => array(
        				'type'  => 'text',
        				'class' => 'form-control input-sm',
        				'placeholder' =>'Título',
        				'maxlength' => '50',
        		),
        
        ));
        
        $this->add(array(
        		'name' => 'email',
        		'attributes' => array(
        				'type'  => 'text',
        				'class' => 'form-control input-sm',
        				'placeholder' =>'E-mail',
        				'maxlength' => '50',
        		),
        
        ));
        
        $this->add(array(
        		'name' => 'observacao',
        		'attributes' => array(
        				'type'  => 'text',
        				'class' => 'form-control input-sm',
        				'placeholder' =>'Observação',
        				'maxlength' => '50',
        		),
        
        ));

      
    }

    public function setObjectManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function getObjectManager()
    {
        return $this->objectManager;
    }
}