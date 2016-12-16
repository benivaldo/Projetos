<?php

namespace CadImposto\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Controle\Model\AbstractModel;

class CadIcms extends AbstractModel
{
     public $icms_id;
     public $cst;
     public $descricao;
     public $tributacao;
     public $csosn;
     public $origem;
     public $aliquota;
     public $base;
     public $mod_icms;
     public $aliquota_st;
     public $base_st;
     public $mod_icms_st;
     public $uso;
     public $texto_nf_id;
     public $cod_tributacao_pdv;
     public $cfop;
    //public $data_cadastro;
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
                 'name'     => 'icms_id',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'Int'),
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
                             'max'      => 50,
                         ),
                     ),
                 ),
             ));
             
             $inputFilter->add(array(
                 'name'     => 'cst',
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
                             'min'      => 2,
                             'max'      => 2,
                         ),
                     ),
                 ),
             ));
             
             $inputFilter->add(array(
                 'name'     => 'csosn',
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
                             'min'      => 3,
                             'max'      => 3,
                         ),
                     ),
                 ),
             ));
             $inputFilter->add(array(
                 'name'     => 'origem',
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
                             'max'      => 2,
                         ),
                     ),
                 ),
             ));
              
             
             $inputFilter->add(array(
                 'name'     => 'tributacao',
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
                             'max'      => 2,
                         ),
                     ),
                 ),
             ));
             
             $inputFilter->add(array(
                'name' => 'aliquota',
                'required' => true,
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
                'name' => 'base',
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
                 'name'     => 'mod_icms',
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
                 'name' => 'aliquota_st',
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
                 'name' => 'base_st',
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
                 'name'     => 'mod_icms_st',
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
                 'name'     => 'uso',
                 'required' => true,
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
                 'name'     => 'texto_nf_id',
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
                             'min'      => 5,
                             'max'      => 255,
                         ),
                     ),
                 ),
             ));
             
             $inputFilter->add(array(
                 'name'     => 'cod_tributacao_pdv',
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
                             'max'      => 4,
                         ),
                     ),
                 ),
             ));
             
             $inputFilter->add(array(
                 'name'     => 'cfop',
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
                             'min'      => 5,
                             'max'      => 5,
                         ),
                     ),
                 ),
             ));
             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
 }