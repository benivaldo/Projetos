<?php

namespace CadImposto\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Controle\Model\AbstractModel;

class CadNcm extends AbstractModel
{
     //public $ncm_id;
     public $codigo;
     public $descricao;
     public $ncm;
     public $ex_tipi;
     public $nat;
     public $pis_entrada_id;
     public $pis_saida_id;
     public $cofins_entrada_id;
     public $cofins_saida_id;
     public $icms_pdv_id;
     public $icms_nf_entrada_id;
     public $icms_nf_saida_id;
     public $ipi_entrada_id;
     public $ipi_saida_id;
     public $mva_st;
     public $cest_id;

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

             /*$inputFilter->add(array(
                 'name'     => 'ncm_id',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
             ));*/

             $inputFilter->add(array(
                 'name'     => 'codigo',
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
                 'name'     => 'ncm',
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
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));
             
             $inputFilter->add(array(
                 'name'     => 'ex_tipi',
                 'required' => false,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
             ));
             
             $inputFilter->add(array(
                 'name'     => 'nat',
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
                             'min'      => 3,
                             'max'      => 3,
                         ),
                     ),
                 ),
             ));
             
             $inputFilter->add(array(
                 'name'     => 'pis_entrada_id',
                 'required' => false,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'Int',
                         'options' => array(
                             'min'      => 1,
                         ),
                     ),
                 ),
             ));
             
             $inputFilter->add(array(
                 'name'     => 'pis_saida_id',
                 'required' => false,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'Int',
                         'options' => array(
                             'min'      => 1,
                         ),
                     ),
                 ),
             ));
             $inputFilter->add(array(
                 'name'     => 'cofins_entrada_id',
                 'required' => false,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'Int',
                         'options' => array(
                             'min'      => 1,
                         ),
                     ),
                 ),
             ));
             
             $inputFilter->add(array(
                 'name'     => 'cofins_saida_id',
                 'required' => false,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'Int',
                         'options' => array(
                             'min'      => 1,
                         ),
                     ),
                 ),
             ));
             
             $inputFilter->add(array(
                 'name'     => 'icms_pdv_id',
                 'required' => false,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'Int',
                         'options' => array(
                             'min'      => 1,
                         ),
                     ),
                 ),
             ));
             
             $inputFilter->add(array(
                 'name'     => 'icms_nf_entrada_id',
                 'required' => false,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'Int',
                         'options' => array(
                             'min'      => 1,
                         ),
                     ),
                 ),
             ));
             
             $inputFilter->add(array(
                 'name'     => 'icms_nf_saida_id',
                 'required' => false,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'Int',
                         'options' => array(
                             'min'      => 1,
                         ),
                     ),
                 ),
             ));
             
             $inputFilter->add(array(
                 'name'     => 'ipi_entrada_id',
                 'required' => false,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'Int',
                         'options' => array(
                             'min'      => 1,
                         ),
                     ),
                 ),
             ));
             
             $inputFilter->add(array(
                 'name'     => 'ipi_saida_id',
                 'required' => false,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'Int',
                         'options' => array(
                             'min'      => 1,
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
                             'min' => 0,
                         ),
                     ),
                 ),
             ) );
             
             $inputFilter->add(array(
                 'name'     => 'cest_id',
                 'required' => false,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'Int',
                         'options' => array(
                             'min'      => 1,
                         ),
                     ),
                 ),
             ));

             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
 }