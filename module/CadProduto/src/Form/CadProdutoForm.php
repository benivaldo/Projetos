<?php
namespace CadProduto\Form;

use Zend\Form\Form;

class CadProdutoForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('produto');

        $this->setAttribute('method', 'post');
        $this->add(array(
                'name' => 'produto_id',
                'attributes' => array(
                'type'  => 'hidden',
                'class' => 'form-control input-sm',
            ),
        ));

        $this->add(array(
                'name' => 'plu',
                'attributes' => array(
                'type'  => 'text',
                'readonly' => 'readonly',
                'class' => 'form-control input-sm',
                'placeholder' =>'Plu',
            ),
            
        ));

        $this->add(array(
                'name' => 'sku',
                'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Código de barras',
            ),
            'options' => array(

            ),
        ));
        
        $this->add(array(
            'name' => 'descricao',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Descrição do produto',
            ),
        
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'ativo',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Sel. status',
                'disable_inarray_validator' => true,
                'value_options' => array(
                 true => 'Ativo',
                 false => 'Inativo',
                )
            )
        ));
        
        
        $this->add(array(
            'name' => 'desc_resumida',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Descrição Resumida do produto',
            ),
        
        ));
        
         
        $this->add(array(
            'name' => 'peso_liquido',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Peso líquido',
            ),
        
        ));
        
        $this->add(array(
            'name' => 'peso_bruto',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Peso bruto',
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
                'empty_option' => 'Selecione uma seção',
                'disable_inarray_validator' => true
            )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'grupo_id',
            'attributes' => array(
                'class' => 'form-control input-sm select-create',
                'data-ctrl_pesquisa' => 'cadsubgrupo',
                'data-novo_select'   => 'subgrupo_id',
                'data-modulo'   => 'caddepartamento'
            ),
            'options' => array(
                'empty_option' => 'Selecione um grupo',
                'disable_inarray_validator' => true
             )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'subgrupo_id',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Selecione um subgrupo',
                'disable_inarray_validator' => true
            )
        ));
        
        /*$this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'grade_id',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => '--Select--',
                'disable_inarray_validator' => true
            )
        ));*/
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'unidade_id',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Sel. unidade',
                'disable_inarray_validator' => true
            )
        ));
        

        $this->add(array(
                'type' => 'Zend\Form\Element\Select',
                'name' => 'tipo_produto_id',
                'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Selecione o tipo de produto',
                'disable_inarray_validator' => true 
                /*'value_options' => array(
                     '1' => 'Rock',
                     '2' => 'Pop',
                 ),*/
            )
        ));
        
        $this->add(array(
            'name' => 'ncm_id',
            'attributes' => array(
                'type'  => 'hidden',
                'class' => 'form-control input-sm',
                'value' => 1, // teste
            ),
        ));
        
        $this->add(array(
            'name' => 'ncm_cod',            
            'attributes' => array(
                'class' => 'form-control input-sm',
                'placeholder' =>'NCM',
            ),
        ));
        
        $this->add(array(
            'name' => 'ncm_desc',
            'attributes' => array(
                'class' => 'form-control input-sm',
                'placeholder' =>'Descrição do NCM',
            ),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'pis_entrada_id',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Selecione o pis para compra',
                'disable_inarray_validator' => true
            )
        ));
        
        $this->add(array(
            'name' => 'aliq_pis_entrada',
            'attributes' => array(
                'class' => 'form-control input-sm',
                'placeholder' =>'Descrição do NCM',
            ),
        ));
        
        $this->add(array(
            'name' => 'cst_pis_entrada',
            'attributes' => array(
                'class' => 'form-control input-sm',
                'placeholder' =>'Descrição do NCM',
            ),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'pis_saida_id',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Selecione o pis para venda',
                'disable_inarray_validator' => true
            )
        ));
        
        $this->add(array(
            'name' => 'aliq_pis_saida',
            'attributes' => array(
                'class' => 'form-control input-sm',
                'placeholder' =>'Aliq. PIS',
            ),
        ));
        
        $this->add(array(
            'name' => 'cst_pis_saida',
            'attributes' => array(
                'class' => 'form-control input-sm',
                'placeholder' =>'CST PIS',
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'cofins_entrada_id',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Selecione o cofins para compra',
                'disable_inarray_validator' => true
            )
        ));
        
        $this->add(array(
            'name' => 'aliq_cofins_entrada',
            'attributes' => array(
                'class' => 'form-control input-sm',
                'placeholder' =>'Aliq. COFINS',
            ),
        ));
        
        $this->add(array(
            'name' => 'cst_cofins_entrada',
            'attributes' => array(
                'class' => 'form-control input-sm',
                'placeholder' =>'CST COFINS',
            ),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'cofins_saida_id',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Selecione o cofins para venda',
                'disable_inarray_validator' => true
            )
        ));
        
        $this->add(array(
            'name' => 'aliq_cofins_saida',
            'attributes' => array(
                'class' => 'form-control input-sm',
                'placeholder' =>'Aliq. COFINS',
            ),
        ));
        
        $this->add(array(
            'name' => 'cst_cofins_saida',
            'attributes' => array(
                'class' => 'form-control input-sm',
                'placeholder' =>'CST COFINS',
            ),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'ipi_entrada_id',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Selecione o IPI para compra',
                'disable_inarray_validator' => true
            )
        ));
        
        $this->add(array(
            'name' => 'aliq_ipi_entrada',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>' Aliq. IPI',
            ),
        
        ));
        
        $this->add(array(
            'name' => 'cst_ipi_entrada',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>' Cst de IPI',
            ),
        
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'ipi_saida_id',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Selecione o IPI para venda',
                'disable_inarray_validator' => true
            )
        ));
        
        $this->add(array(
            'name' => 'aliq_ipi_saida',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>' Aliq. IPI',
            ),
        
        ));
        
        $this->add(array(
            'name' => 'cst_ipi_saida',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>' Cst de IPI',
            ),
        
        ));
        
        $this->add(array(
            'name' => 'mva_st',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'MVA ST',
            ),
        
        ));
        
        $this->add(array(
            'name' => 'estoque_min',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Estoque mínimo',
            ),
        
        ));
        
        $this->add(array(
            'name' => 'estoque_ideal',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Estoque ideal',
            ),
        
        ));
        
        $this->add(array(
            'name' => 'cod_fornecedor',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Cód. Fornecedor',
            ),
        
        ));
        
        $this->add(array(
            'name' => 'ref_fornecedor',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Ref. fornecedor',
            ),
        
        ));
        
         
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'icms_pdv_id',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Selecione tributação do pdv',
                'disable_inarray_validator' => true
            )
        ));
        
        $this->add(array(
            'name' => 'trib_pdv',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Trib. do PDV',
            ),
        
        ));
        
        $this->add(array(
            'name' => 'aliq_pdv',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Alíquota do PDV',
            ),
        
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'icms_nf_entrada_id',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Selecione tributação do icms para compra',
                'disable_inarray_validator' => true
            )
        ));
        
        $this->add(array(
            'name' => 'reducao_base_entrada',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Redução de Base',
            ),
        
        ));
        
        $this->add(array(
            'name' => 'aliq_base_entrada',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>' Aliq. Red. Base',
            ),
        
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'icms_nf_saida_id',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Selecione tributação do icms para venda',
                'disable_inarray_validator' => true
            )
        ));
        
        $this->add(array(
            'name' => 'reducao_base_saida',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>'Redução de Base',
            ),
        
        ));
        
        $this->add(array(
            'name' => 'aliq_base_saida',
            'attributes' => array(
                'type'  => 'text',
                'class' => 'form-control input-sm',
                'placeholder' =>' Aliq. Red. Base',
            ),
        
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'fornecedor_id',
            'attributes' => array(
                'class' => 'form-control input-sm',
            ),
            'options' => array(
                'empty_option' => 'Selecione um fornecedor',
                'disable_inarray_validator' => true
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
