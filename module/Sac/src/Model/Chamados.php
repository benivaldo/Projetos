<?php

namespace Sac\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Chamados implements InputFilterAwareInterface
{
     public $secao_id;
     public $descricao;
     public $data_altera;
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
                 'name'     => 'secao_id',
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
                    /* array(
                         'name' =>'NotEmpty',
                         'options' => array(
                             'messages' => array(
                                 \Zend\Validator\NotEmpty::IS_EMPTY => 'Entre com a descrição!'
                             ),
                         ),
                     ),*/
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 50,
                             'messages' => array(
                                 'stringLengthTooShort' => 'A descrição de conter de 1 a 50 characteres!',
                                 'stringLengthTooLong' => 'A descrição de conter de 1 a 50 characteres!'
                             ),
                         ),
                     ),
                 ),
             ));



             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
     
     public function exchangeArray($data)
     {
     	foreach ($data as $key => $value) {
     		$this->$key = (!empty($value) ? $value: null);
     	}
     }
     
     public function toArray()
     {
     	return $this->getArrayCopy();
     }
     
     public function getArrayCopy()
     {
     	$data =  get_object_vars($this);
     	unset($data['inputFilter']);
     	unset($data['voltar']);
     	unset($data['limpar']);
     	unset($data['submit']);
     	return $data;
     }
     
      
 }