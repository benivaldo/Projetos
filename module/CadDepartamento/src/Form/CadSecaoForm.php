<?php
namespace CadDepartamento\Form;

use Zend\Form\Form;

class CadSecaoForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('secao');

        $this->setAttribute('method', 'post');
        $this->add(array(
                'name' => 'secao_id',
                'attributes' => array(
                    'type'  => 'text',
                    'class' => 'form-control input-sm',
                    'placeholder' =>'Código',
                    'readonly'  => 'readonly',
            ),
        ));

        $this->add(array(
                'name' => 'descricao',
                'attributes' => array(
                    'type'  => 'text',
                    'class' => 'form-control input-sm',
                    'placeholder' =>'Descrição da seção',
                    'maxlength' => '50',
            ),
            
        ));
       
        
        $this->add(array(
            'name' => 'data_altera',
            'attributes' => array(
                'type'  => 'hidden',
                'class' => 'form-control input-sm',
                'value' => date("Y-m-d")
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
