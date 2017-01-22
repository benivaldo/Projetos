<?php
namespace Controle\Model;

abstract class AbstractModel
{
	protected $inputFilter;
	
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

    abstract public function getInputFilter();
}