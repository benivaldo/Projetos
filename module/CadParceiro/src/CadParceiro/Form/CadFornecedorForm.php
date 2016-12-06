<?php
namespace CadParceiro\Form;

use Zend\Form\Form;

class CadFornecedorForm extends Form
{
   public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('fornecedor');

        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'fornecedor_id',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Código',
                'readonly'  => 'readonly',
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'tipo',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Sel. tipo pessoa',
                'disable_inarray_validator' => true,
                'value_options' => array(
                    'j' => 'Jurídica',
                    'f' => 'Fisica',
                ),
            )
        ));
        
        $this->add(array(
            'name' => 'cnpj_cpf',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'CNPJ',
            ),            
        ));
        
        $this->add(array(
            'name' => 'cnpj_cpf',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'CNPJ',
            ),        
        ));

        $this->add(array(
            'name' => 'ie_rg',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Inscrição Estadual',
            ),        
        ));
        
        $this->add(array(
            'name' => 'ie_st',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Inscrição Estadual ST',
            ),        
        ));
        
        $this->add(array(
            'name' => 'razao',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Razão social',
            ),        
        ));
        
        $this->add(array(
            'name' => 'fantasia',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Nome Fantasia',
            ),        
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'crt',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Cód. Regime Tributário',
                'disable_inarray_validator' => true
                /*'value_options' => array(
                 '1' => 'Rock',
                    '2' => 'Pop',
                ),*/
            )
        ));
        
        $this->add(array(
            'name' => 'cep',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Cep',
            ),
            'options' => array(

            ),
        ));
        
        $this->add(array(
            'name' => 'logradouro',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Logradouro',
            ),
            'options' => array(
        
            ),
        ));
        
        $this->add(array(
            'name' => 'numero',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Número',
            ),
            'options' => array(
        
            ),
        ));
        
        $this->add(array(
            'name' => 'complemento',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Complemennto',
            ),
            'options' => array(
        
            ),
        ));
        
        $this->add(array(
            'name' => 'bairro',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Bairro',
            ),
            'options' => array(
        
            ),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'cidade',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Selecione a cidade',
                'disable_inarray_validator' => true
                /*'value_options' => array(
                 '1' => 'Rock',
                    '2' => 'Pop',
                ),*/
            )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'uf',
            'attributes' => array(
                'class' => 'form-control input-sm select-create',
                'data-ctrl_pesquisa' => 'tabcidades',
                'data-novo_select'   => 'cidade',
                'data-modulo'   => 'tabacessorias'
            ),
            'options' => array(
                'empty_option' => 'Estado',
                'disable_inarray_validator' => true
                /*'value_options' => array(
                 '1' => 'Rock',
                    '2' => 'Pop',
                ),*/
            )
        ));
        
        $this->add(array(
            'name' => 'contato',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Contato',
            ),
            'options' => array(
        
            ),
        ));
        
        $this->add(array(
            'name' => 'observacao',
            'attributes' => array(
                'type'  => 'textarea',
                'class' => 'form-control input-sm',
                'placeholder' =>'Observação',
            ),
            'options' => array(
        
            ),
        ));
        
        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'E-mail',
            ),
            'options' => array(
        
            ),
        ));
        
        /*$this->add(array(
            'name' => 'suframa',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Suframa',
            ),
            'options' => array(
        
            ),
        ));*/
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'centro_custo_id',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Selecione o centro de custo',
                'disable_inarray_validator' => true
                /*'value_options' => array(
                 '1' => 'Rock',
                    '2' => 'Pop',
                ),*/
            )
        ));
        
        $this->add(array(
            'name' => 'telefone',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Telefone',
            ),
            'options' => array(
        
            ),
        ));
        
        $this->add(array(
            'name' => 'ramal',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Ramal',
            ),
            'options' => array(
        
            ),
        ));
        
        $this->add(array(
            'name' => 'celular',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Celular',
            ),
            'options' => array(
        
            ),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'ativo',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Sel.',
                'disable_inarray_validator' => true,
                'value_options' => array(
                    true => 'Ativo',
                    false => 'Inativo',
                ),
            )
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
            'name' => 'data_cadastro',
            'attributes' => array(
                'type'  => 'hidden',
                'class' => 'form-control input-sm',
                'value' => date("Y-m-d")
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
