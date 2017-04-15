<?php
namespace Sac\Form;

use Zend\Form\Form;

class ChamadosForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('secao');

        $this->setAttribute('method', 'post');
        
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        
        $this->add(array(
                'name' => 'pedido',
                'attributes' => array(
                    'type'  => 'text',
                    'class' => 'form-control input-sm',
                    'placeholder' =>'Número do pedido',
            ),
        ));

        $this->add(array(
                'name' => 'cliente',
                'attributes' => array(
                    'type'  => 'text',
                    'class' => 'form-control input-sm',
                    'placeholder' =>'Nome do cliente',
                    'maxlength' => '80',
            ),
            
        ));
        
        $this->add(array(
        		'name' => 'titulo',
        		'attributes' => array(
        				'type'  => 'text',
        				'class' => 'form-control input-sm',
        				'placeholder' =>'Título',
        				'maxlength' => '80',
        		),
        
        ));
        
        $this->add(array(
        		'name' => 'email',
        		'attributes' => array(
        				'type'  => 'text',
        				'class' => 'form-control input-sm',
        				'placeholder' =>'E-mail',
        				'maxlength' => '80',
        		),
        
        ));
        
        $this->add(array(
        		'name' => 'observacao',
        		'attributes' => array(
        				'type'  => 'Zend\Form\Element\Textarea',
        				'class' => 'form-control input-sm',
        				'placeholder' =>'Observação',
        				'maxlength' => '255',
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
}
