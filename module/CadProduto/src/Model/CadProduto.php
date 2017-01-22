<?php

namespace CadProduto\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Controle\Model\AbstractModel;

class CadProduto extends AbstractModel
{
     public $produto_id;
     public $plu;
     public $sku_id;
     public $ativo;
     public $descricao;
     public $desc_resumida;
     public $ncm_id;
     public $secao_id;
     public $grupo_id;
     public $subgrupo_id;
     public $fornecedor_id;
     //public $grade_id;
     public $unidade_id;
     public $tipo_produto_id;
     public $icms_nf_entrada_id;
     public $icms_nf_saida_id;
     public $icms_pdv_id;
     public $pis_entrada_id;
     public $pis_saida_id;
     public $cofins_entrada_id;
     public $cofins_saida_id;
     public $ipi_entrada_id;
     public $ipi_saida_id;
     public $mva_st;
     public $peso_liquido;
     public $peso_bruto;
     public $estoque_min;
     public $estoque_ideal;
     //public $curva_abc;
     //public $carga_pdv;
     //public $prod_balanca;
     //public $permite_frac;
     //public $permite_preco;

     protected $inputFilter;                       // <-- Add this variable

     // Add content to these methods:
     public function setInputFilter(InputFilterInterface $inputFilter)
     {
         throw new \Exception("Not used");
     }

     public function getInputFilter()
     {
         if (!$this->inputFilter) {
             $inputFilter = new InputFilter();

             $inputFilter->add(array(
                 'name'     => 'produto_id',
                 'required' => false,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
             ));
             
             $inputFilter->add(array(
                 'name'     => 'ativo',
                 'required' => true,
                 'validators' => array(
                    array(
                      'name' =>'NotEmpty', 
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Campo Status Obrigatório.' 
                            ),
                        ),
                    ),
                ),
             ));

             $inputFilter->add(array(
                 'name'     => 'descricao',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 60,
                         ),
                     ),
                 ),
             ));

             $inputFilter->add(array(
                 'name'     => 'desc_resumida',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 22,
                         ),
                     ),
                 ),
             ));
             
             $inputFilter->add(array(
                 'name'     => 'ncm_id',
                 'required' => false,
                 'validators' => array(
                    array(
                      'name' =>'NotEmpty', 
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Campo Seção Obrigatório.' 
                            ),
                        ),
                    ),
                ),
             ));
             
             $inputFilter->add(array(
                 'name'     => 'secao_id',
                 'required' => true,
                 'validators' => array(
                    array(
                      'name' =>'NotEmpty', 
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Campo Seção Obrigatório.' 
                            ),
                        ),
                    ),
                ),
             ));
             
             $inputFilter->add(array(
                 'name'     => 'grupo_id',
                 'required' => true, 
                 'validators' => array(
                    array(
                      'name' =>'NotEmpty', 
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Campo Grupo Obrigatório.' 
                            ),
                        ),
                    ),
                ),
             ));
             
             $inputFilter->add(array(
                 'name'     => 'subgrupo_id',
                 'required' => true,
                 'validators' => array(
                    array(
                      'name' =>'NotEmpty', 
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Campo Subgrupo Obrigatório.' 
                            ),
                        ),
                    ),
                ),
             ));
             
             $inputFilter->add(array(
                 'name'     => 'fornecedor_id',
                 'required' => false,
                 'validators' => array(
                    array(
                      'name' =>'NotEmpty', 
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Campo Seção Obrigatório.' 
                            ),
                        ),
                    ),
                ),
             ));
             
            $inputFilter->add(array(
                'name'     => 'unidade_id',
                'required' => true,
                'validators' => array(
                    array(
                      'name' =>'NotEmpty', 
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Campo Unidade Obrigatório.' 
                            ),
                        ),
                    ),
                ),
            ));
            
            $inputFilter->add(array(
                'name'     => 'tipo_produto_id',
                'required' => true,
                'validators' => array(
                    array(
                      'name' =>'NotEmpty', 
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Campo Tipo de Produto Obrigatório.' 
                            ),
                        ),
                    ),
                ),
            ));
            
            $inputFilter->add(array(
                'name'     => 'icms_nf_entrada_id',
                'required' => true,
                 'validators' => array(
                    array(
                      'name' =>'NotEmpty', 
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Campo Icms de compra Obrigatório.' 
                            ),
                        ),
                    ),
                ),
            ));
            
            $inputFilter->add(array(
                'name'     => 'icms_nf_saida_id',
                'required' => true,
                 'validators' => array(
                    array(
                      'name' =>'NotEmpty', 
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Campo Icms de venda Obrigatório.' 
                            ),
                        ),
                    ),
                ),
            ));
            
            $inputFilter->add(array(
                'name'     => 'icms_pdv_id',
                'required' => true,
                 'validators' => array(
                    array(
                      'name' =>'NotEmpty', 
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Campo Trib. ECF Obrigatório.' 
                            ),
                        ),
                    ),
                ),
            ));
            
            $inputFilter->add(array(
                'name' => 'mva_st',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
                'validators' => array(
                    array(
                        'name' => 'Regex',
                        'options' => array(
                            'pattern' => '/^[-+]?([0-9]+(\.[0-9]+)?|\.[0-9]+)$/',
                        ),
                    ),
                ),
            ) );
            
            $inputFilter->add(array(
                'name'     => 'pis_entrada_id',
                'required' => false,
                'validators' => array(
                    array(
                      'name' =>'NotEmpty', 
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Campo Pis de compra Obrigatório.' 
                            ),
                        ),
                    ),
                ),
            ));
            
            $inputFilter->add(array(
                'name'     => 'pis_saida_id',
                'required' => false,
                'validators' => array(
                    array(
                      'name' =>'NotEmpty', 
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Campo Pis de venda Obrigatório.' 
                            ),
                        ),
                    ),
                ),
            ));
            
            $inputFilter->add(array(
                'name'     => 'cofins_entrada_id',
                'required' => false,
                'validators' => array(
                    array(
                      'name' =>'NotEmpty', 
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Campo Cofins de compra Obrigatório.' 
                            ),
                        ),
                    ),
                ),
            ));
            
            $inputFilter->add(array(
                'name'     => 'cofins_saida_id',
                'required' => false,
                 'validators' => array(
                    array(
                      'name' =>'NotEmpty', 
                        'options' => array(
                            'messages' => array(
                                \Zend\Validator\NotEmpty::IS_EMPTY => 'Campo Cofins de venda Obrigatório.' 
                            ),
                        ),
                    ),
                ),
            ));
            
            $inputFilter->add(array(
                'name'     => 'ipi_entrada_id',
                'required' => false,
            ));
            
            $inputFilter->add(array(
                'name'     => 'ipi_saida_id',
                'required' => false,
            ));
            
            $inputFilter->add(array(
                'name'     => 'cod_fornecedor',
                'required' => false,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 20,
                        ),
                    ),
                ),
            ));
            
            $inputFilter->add(array(
                'name'     => 'ref_fornecedor',
                'required' => false,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 20,
                        ),
                    ),
                ),
            ));
            
            $inputFilter->add(array(
                'name' => 'peso_liquido',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
                'validators' => array(
                    array(
                        'name' => 'Regex',
                        'options' => array(
                            'pattern' => '/^[-+]?([0-9]+(\.[0-9]+)?|\.[0-9]+)$/',  
                        ),
                    ),
                ),
            ) );
            
            $inputFilter->add(array(
                'name' => 'peso_bruto',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
                'validators' => array(
                    array(
                        'name' => 'Regex',
                        'options' => array(
                            'pattern' => '/^[-+]?([0-9]+(\.[0-9]+)?|\.[0-9]+)$/',
                        ),
                    ),
                ),
            ) );
            
            $inputFilter->add(array(
                'name' => 'estoque_min',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
                'validators' => array(
                    array(
                        'name' => 'Regex',
                        'options' => array(
                            'pattern' => '/^[-+]?([0-9]+(\.[0-9]+)?|\.[0-9]+)$/',
                        ),
                    ),
                ),
            ) );
            
            $inputFilter->add(array(
                'name' => 'estoque_ideal',
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
                'validators' => array(
                    array(
                        'name' => 'Regex',
                        'options' => array(
                            'pattern' => '/^[-+]?([0-9]+(\.[0-9]+)?|\.[0-9]+)$/',
                        ),
                    ),
                ),
            ) );
            
           /* $inputFilter->add(array(
                'name'     => 'grade_id',
                'required' => false,
            ));*/

             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
 }