<?php
namespace CadImposto\Form;

use Zend\Form\Form;

class CadIcmsForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('icms');

        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'icms_id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));

         $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'cst',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Selecione o CST',
                'disable_inarray_validator' => true,
                /*'value_options' => array(
                 '1' => 'Rock',
                    '2' => 'Pop',
                ),*/
            )
        ));

        $this->add(array(
            'name' => 'descricao',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Descrição',
                'maxlength' => '50',
            ),
            'options' => array(

            ),
        ));
        
         $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'tributacao',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Sel. Cod. de tributação',
                'disable_inarray_validator' => true,
                'value_options' => array(
                'T' => 'Tributado',
                'NT' => 'Não Tributado',
                'ST' => "Situação Tributária",
                'I' => 'Isento',
                'D' => 'Diferido',
                'S' => 'Substituição Tributária',
                ),
            )
        ));
         
         $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'csosn',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Selecione o CSOSN',
                'disable_inarray_validator' => true,
                /*'value_options' => array(
                 '1' => 'Rock',
                    '2' => 'Pop',
                ),*/
            )
        ));
         
         $this->add(array(
             'type' => 'Zend\Form\Element\Select',
             'name' => 'origem',
             'attributes' => array(
                 'class' => 'form-control input-sm',
             ),
             'options' => array(
                 'empty_option' => 'Sel. origem da mercadoria',
                 'disable_inarray_validator' => true,
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
            'name' => 'base',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Base redução',
            ),
            'options' => array(
        
            ),
        ));
        
        $this->add(array(
                'type' => 'Zend\Form\Element\Select',
                'name' => 'mod_icms',
                'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Selecione a modalidade da BC ICMS',
                'disable_inarray_validator' => true,
                'value_options' => array(
                '0' => 'Margem Valor Agregado (%)',
                '1' => 'Pauta (Valor)',
                '2' => 'Preço Tabelado Máx. (valor)',
                '3' => 'Valor da Operação',
                 ),
            )
        ));

        $this->add(array(
            'name' => 'aliquota_st',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Alíquota de ST',
            ),
            'options' => array(
        
            ),
        ));
        
        $this->add(array(
            'name' => 'base_st',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Base de redução ST',
            ),
            'options' => array(
        
            ),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'mod_icms_st',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Selecione a modalidade da BC ICMS ST',
                'disable_inarray_validator' => true,
                'value_options' => array(
                    '0' => 'Preço tabelado ou máximo sugerido',
                    '1' => 'Lista Negativa (valor)',
                    '2' => 'Lista Positiva (valor)',
                    '3' => ' Lista Neutra (valor)',
                    '4' => ' Margem Valor Agregado (%)',
                    '5' => 'Pauta (valor)',
                ),
            )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'uso',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Selecione a finalidade de uso',
                'disable_inarray_validator' => true,
                'value_options' => array(
                 '1' => 'Entrada e Saida',
                 '2' => 'Entrada',
                 '3' => 'Saida',
                 '4' => 'PDV',
                ),
            )
        ));
        
        $this->add(array(
            'name' => 'texto_nf_id',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Texto pra emissão de notas de saída',
            ),
            'options' => array(
        
            ),
        ));
        
        $this->add(array(
            'name' => 'cod_tributacao_pdv',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Cod. Pdv',
            ),
            'options' => array(
        
            ),
        ));
        
        $this->add(array(
            'name' => 'cfop',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'CFOP',
            ),
            'options' => array(
        
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
