<?php
namespace CadImposto\Form;

use Zend\Form\Form;

class CadNcmForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('ncm');

        $this->setAttribute('method', 'post');
        $this->add(array(
                'name' => 'ncm_id',
                'attributes' => array(
                    'type'  => 'hidden',
            ),
        ));

        $this->add(array(
                'name' => 'codigo',
                'attributes' => array(
                    'type'  => 'text',
                    'class' => 'form-control input-sm',
                    'placeholder' =>'Código',
                    'maxlength' => '20',
            ),            
        ));
        
        $this->add(array(
            'name' => 'ncm',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'maxlength' => '10',
                'placeholder' =>'NCM',
            ),        
        ));
        
        $this->add(array(
            'name' => 'descricao',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Descrição',
                'maxlength' => '255',
            ),
        
        ));

        $this->add(array(
            'name' => 'ex_tipi',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'EX TIPI',                
            ),
            'options' => array(

            ),
        ));
        
        $this->add(array(
            'name' => 'nat',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Natureza de operação',
                'maxlength' => '3',
            ),
        
        ));
        
        $this->add(array(
                'type' => 'Zend\Form\Element\Select',
                'name' => 'pis_entrada_id',
                'attributes' => array(
                    'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Selecione o CST de PIS de entrada',
                'disable_inarray_validator' => true 
                /*'value_options' => array(
                     '1' => 'Rock',
                     '2' => 'Pop',
                 ),*/
            )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'pis_saida_id',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Selecione o CST de PIS de saída',
                'disable_inarray_validator' => true
                /*'value_options' => array(
                 '1' => 'Rock',
                    '2' => 'Pop',
                ),*/
            )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'cofins_entrada_id',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Selecione o CST de COFINS de entrada',
                'disable_inarray_validator' => true
                /*'value_options' => array(
                 '1' => 'Rock',
                    '2' => 'Pop',
                ),*/
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'cofins_saida_id',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Selecione o CST de COFINS de saída',
                'disable_inarray_validator' => true
                /*'value_options' => array(
                 '1' => 'Rock',
                    '2' => 'Pop',
                ),*/
            )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'icms_pdv_id',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Selecione o ICMS de saída para PDV',
                'disable_inarray_validator' => true
                /*'value_options' => array(
                 '1' => 'Rock',
                    '2' => 'Pop',
                ),*/
            )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'icms_nf_entrada_id',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Selecione o ICMS para nota fiscal de entrada',
                'disable_inarray_validator' => true
                /*'value_options' => array(
                 '1' => 'Rock',
                    '2' => 'Pop',
                ),*/
            )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'icms_nf_saida_id',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Selecione o ICMS para nota fiscal de saída',
                'disable_inarray_validator' => true
                /*'value_options' => array(
                 '1' => 'Rock',
                    '2' => 'Pop',
                ),*/
            )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'ipi_entrada_id',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Selecione o IPI de entrada',
                'disable_inarray_validator' => true
                /*'value_options' => array(
                 '1' => 'Rock',
                    '2' => 'Pop',
                ),*/
            )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'ipi_saida_id',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Selecione o IPI de entrada',
                'disable_inarray_validator' => true
                /*'value_options' => array(
                 '1' => 'Rock',
                    '2' => 'Pop',
                ),*/
            )
        ));
        
        $this->add(array(
            'name' => 'mva_st',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'MVA',
            ),
        
        ));
        
        $this->add(array(
            'name' => 'cest_id',
            'attributes' => array(
                'type'  => 'hidden',
                'class' => 'form-control input-sm',
                'placeholder' =>'CEST',
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
