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
 * @ORM\Table(name="chamados")
 */
class Chamados
{
	protected $inputFilter;
	
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(name="id")
	 */
	protected $id;

	/**@var string
	 * @ORM\Column(name="titulo")
	 */
	protected $titulo;
	
	/**@var string
	 * @ORM\Column(name="observacao")
	*/
	protected $observacao;

	/**@var string
	 * @ORM\Column(name="email")
	*/
	protected $email;
	
	/**@var integer
	 * @ORM\Column(name="clienteid")
	*/
	protected $clienteId;
	
	/**@var integer
	 * @ORM\Column(name="pedidoid")
	*/
	protected $pedidoId;

	
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
	
	
	// Returns titulo.
	public function getTitulo()
	{
		return $this->titulo;
	}
	
	// Sets titulo.
	public function setTitulo($titulo)
	{
		$this->titulo = $titulo;
	}
	
	// Returns clientes.
	public function getClienteId()
	{
		return $this->clienteId;
	}
	
	// Sets clientes.
	public function setClienteId($clienteId)
	{
		$this->clienteId = $clienteId;
	}
	
	// Returns pedidos.
	public function getPedidoId()
	{
		return $this->pedidoId;
	}
	
	// Sets pedidos.
	public function setPedidoId($pedidoId)
	{
		$this->pedidoId = $pedidoId;
	}
	
	// Returns email.
	public function getEmail()
	{
		return $this->email;
	}
	
	// Sets pedidos.
	public function setEmail($email)
	{
		$this->email = $email;
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
					'name'     => 'titulo',
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
											'messages' => array(
													'stringLengthTooShort' => 'A descrição deve conter de 1 a 100 characteres!',
													'stringLengthTooLong' => 'A descrição deve conter de 1 a 100 characteres!'
											),
									),
							),
					),
			));
			
			$inputFilter->add(array(
					'name'     => 'email',
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
											'messages' => array(
													'stringLengthTooShort' => 'O e-mail deve conter de 1 a 100 characteres!',
													'stringLengthTooLong' => 'O e-mail deve conter de 1 a 100 characteres!'
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