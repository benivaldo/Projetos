<?php
namespace Sac\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Sac\Repository\ChamadosRepository")
 * @ORM\Table(name="cad_secao")
 */
class Chamados
{
	protected $inputFilter;
	
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(name="secao_id")
	 */
	protected $id;

	/**
	 * @ORM\Column(name="descricao")
	 */
	protected $descricao;

	
	/**
	 * @ORM\Column(name="data_cadastro")
	 */
	protected $dataCadastro;
	
	/**
	 * @ORM\Column(name="data_altera")
	 */
	protected $dataAltera;
	
	
	// Returns ID of this chamados.
	public function getId()
	{
		return $this->id;
	}
	
	// Sets ID of this chamados.
	public function setId($id)
	{
		$this->id = $id;
	}
	
	
	// Returns descricao.
	public function getDescricao()
	{
		return $this->descricao;
	}
	
	// Sets descricao.
	public function setDescricao($descricao)
	{
		$this->descricao = $descricao;
	}
	
	// Returns dataCadastro.
	public function getDataCadastro()
	{
		return $this->dataCadastro;
	}
	
	// Sets DataCadastro.
	/**
	 * @ORM\PrePersist
	 */
	public function setDataCadastro()
	{
		$this->dataCadastro = date('Y-m-d');
	}
	
	// Returns dataCadastro.
	public function getDataAltera()
	{
		return $this->dataAltera;
	}
	
	// Sets DataCadastro.
	public function setDataAltera($dataAltera)
	{
		$this->dataAltera = $dataAltera;
	}
	
	
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