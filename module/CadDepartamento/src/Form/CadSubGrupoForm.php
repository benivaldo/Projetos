<?php
namespace CadDepartamento\Form;

use Zend\Form\Form;

class CadSubGrupoForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('subgrupo');

        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'subgrupo_id',
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
                'placeholder' =>'Descrição do subgrupo',
                'maxlength' => '50',
            ),
            
        ));
       
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'secao_id',
            'attributes' => array(
                'class' => 'form-control input-sm select-create',
                'data-ctrl_pesquisa' => 'cadgrupo',
                'data-novo_select'   => 'grupo_id',
                'data-modulo'   => 'caddepartamento'
            ),
            'options' => array(
                'empty_option' => 'Selecione a Seção',
                'disable_inarray_validator' => true,
                /*'value_options' => array(
                 'true' => 'Ativo',
                 'false' => 'Inativo',
                )*/
            )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'grupo_id',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Selecione o Grupo',
                'disable_inarray_validator' => true,
                /*'value_options' => array(
                 'true' => 'Ativo',
                    'false' => 'Inativo',
                )*/
            )
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
