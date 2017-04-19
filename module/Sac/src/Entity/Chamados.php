<?php
namespace Sac\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Doctrine\Common\Collections\ArrayCollection;

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

	/**
	 * @ORM\Column(name="titulo")
	 */
	protected $titulo;
	
	/**
	 * @ORM\Column(name="observacao")
	*/
	protected $observacao;

	/**
	 * @ORM\Column(name="email")
	*/
	protected $email;
	
		
		
	/**
	*
	* @ORM\ManyToOne(targetEntity="\Sac\Entity\Clientes", inversedBy="chamados")
	* @ORM\JoinColumn(name="clienteid", referencedColumnName="id")
	*/
	protected $clientes;
	
	
	/**
	 *
	 * @ORM\ManyToOne(targetEntity="\Sac\Entity\Pedidos", inversedBy="chamados")
	 * @ORM\JoinColumn(name="pedidoid", referencedColumnName="id")
	 */
	protected $pedidos;
	
	/*public function __construct()
	{
		$this->clientes = new ArrayCollection();
		$this->pedidos = new ArrayCollection();
	}*/
	
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
		return $this;
	}
	
	// Returns clientes.
	public function getClientes()
	{
		return $this->clientes->toArray();
	}
	
	/**
     * Set clientes
     * @param \Sac\Entity\Clientes $cliente
     * @return Pedido
     */
	public function setClientes($clientes)
	{
		$this->clientes = $clientes;
		return $this;
	}
	
	// Returns pedidos.
	public function getPedidos()
	{
		return $this->pedidos->toArray();
	}
	
	// Sets pedidos.
	public function setPedidos($pedidos)
	{
		$this->pedidos = $pedidos;
		return $this;
	}
	
	// Returns email.
	public function getEmail()
	{
		return $this->email;
	}
	
	// Sets email.
	public function setEmail($email)
	{
		$this->email = $email;
	}
	
	// Returns observacao.
	public function getObservacao()
	{
	    return $this->observacao;
	}
	
	// Sets observacao.
	public function setObservacao($observacao)
	{
	    $this->observacao = $observacao;
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
											'max'      => 80,
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
											'max'      => 80,
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