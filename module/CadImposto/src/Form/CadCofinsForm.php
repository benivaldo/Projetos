<?php
namespace CadImposto\Form;

use Zend\Form\Form;

class CadCofinsForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('cofins');

        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'cofins_id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));

        $this->add(array(
            'name' => 'descricao',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Descrição',
            ),
            
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'codigo',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Selecione o CST de COFINS',
                'disable_inarray_validator' => true
                /*'value_options' => array(
                 '1' => 'Rock',
                    '2' => 'Pop',
                ),*/
            )
        ));
        $this->add(array(
            'name' => 'aliquota',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Alíquota',
            ),
            'options' => array(

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
