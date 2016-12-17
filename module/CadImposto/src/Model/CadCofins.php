<?php

namespace CadImposto\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Controle\Model\AbstractModel;

class CadCofins extends AbstractModel
{
     //public $cofins_id;
     public $codigo;
     public $descricao;
     public $aliquota;
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
                 'name'     => 'cofins_id',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'Int'),
                 ),
             ));*/

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
                 'name'     => 'codigo',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'NotEmpty',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 2,
                             'max'      => 2,
                             'messages' => array(
                                  \Zend\Validator\NotEmpty::IS_EMPTY => 'O CST é obrigatório e não pode estar vazio '
                             ),
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
            
            $this->inputFilter = $inputFilter;
        }

         return $this->inputFilter;
     }
 }