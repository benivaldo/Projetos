<?php
namespace Sac\Form;


use Zend\Form\Form;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;

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
    	
    	$this->setAttribute('method', 'post');
        
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
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

        $this->add(array(
                'name' => 'submit',
                'attributes' => array(
                'type'  => 'submit',
                'value' => 'Alterar',
                'id' => 'submit',
                'class' => 'btn btn-default btn-sm'
            ),
        ));
        
        $this->add(array(
                'name' => 'voltar',
                'attributes' => array(
                'type'  => 'button',
                'value' => 'Voltar',
                'id' => 'voltar',
                'class' => 'btn btn-default btn-sm'
            ),
        ));
        
        $this->add(array(
            'name' => 'limpar',
            'attributes' => array(
                'type'  => 'button',
                'value' => 'Limpar',
                'id' => 'limpar',
                'class' => 'btn btn-default btn-sm'
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