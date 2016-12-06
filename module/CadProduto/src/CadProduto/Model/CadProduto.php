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
     public $grade_id;
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
     public $curva_abc;
     public $carga_pdv;
     public $prod_balanca;
     public $permite_frac;
     public $permite_preco;
     public $data_cadastro;
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
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
             ));

             $inputFilter->add(array(
                 'name'     => 'artist',
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
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));

             $inputFilter->add(array(
                 'name'     => 'title',
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
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));
             
             $inputFilter->add(array(
                 'name'     => 'genreid',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
             ));

             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
 }