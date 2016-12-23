<?php

namespace CadDepartamento\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Controle\Model\AbstractModel;

class CadGrupo extends AbstractModel
{
    public $grupo_id;
    public $descricao;
    public $secao_id;
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
                'name'     => 'grupo_id',
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
                            'messages' => array(
                                'stringLengthTooShort' => 'A descrição de conter de 1 a 50 characteres!',
                                'stringLengthTooLong' => 'A descrição de conter de 1 a 50 characteres!'
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
 
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }
}