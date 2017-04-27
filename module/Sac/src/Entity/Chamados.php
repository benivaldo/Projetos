<?php
namespace Sac\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Sac\Repository\ChamadosRepository")
 * @ORM\EntityListeners({"Sac\Entity\ChamadosListener"}) 
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
	 * @var datetime
	 * @ORM\Column(name="data_cadastro")
	 */
	protected $data_cadastro;
	
	/**
	 * @var datetime
	 * @ORM\Column(name="data_altera")
	 */	
	protected $data_altera;
	
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
	
	/**
	 * Returns ID of this chamados
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Sets ID of this chamados.
	 * @param integer $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}
	
	/**
	 * Returns titulo.
	 */
	public function getTitulo()
	{
		return $this->titulo;
	}
	
/**
	 * Sets titulo.
	 * @param string $titulo
	 * @return \Sac\Entity\Chamados
	 */
	public function setTitulo($titulo)
	{
		$this->titulo = $titulo;
		return $this;
	}
	
	/**
	 *  Returns clientes.
	 * @return \Sac\Entity\Clientes
	 */
	public function getClientes()
	{
		return $this->clientes;
	}
	
	/**
     * Set clientes
     * @param \Sac\Entity\Clientes $clientes
     * @return Chamados
     */
	public function setClientes(\Sac\Entity\Clientes $clientes = null)
	{
		$this->clientes = $clientes;
		return $this;
	}

	/**
	 * Returns pedidos.
	 * @return \Sac\Entity\Pedidos
	 */
	public function getPedidos()
	{
		return $this->pedidos;
	}
	
	/**
     * Set pedidos
     * @param \Sac\Entity\Pedidos $pedidos
     * @return Chamados
     */
	public function setPedidos(\Sac\Entity\Pedidos $pedidos = null)
	{
		$this->pedidos = $pedidos;
		return $this;
	}
	
	/**
	 * Returns email.
	 */
	public function getEmail()
	{
		return $this->email;
	}
	
	/**
	 * Sets email.
	 * @param string $email
	 */
	public function setEmail($email)
	{
		$this->email = $email;
	}
	
	/**
	 * Returns observacao.
	 */
	public function getObservacao()
	{
	    return $this->observacao;
	}
	
	/**
	 * Sets observacao.
	 * @param string $observacao
	 */
	public function setObservacao($observacao)
	{
	    $this->observacao = $observacao;
	}
	
	/**
	 * Gets triggered only on insert
	 * @ORM\PrePersist
	 */
	public function onPrePersist()
	{
		$this->data_cadastro = date('Y-m-d');
	}
	
	/**
	 * Gets triggered every time on update
	 * @ORM\PreUpdate
	 */
	public function onPreUpdate()
	{
		$this->data_altera = date('Y-m-d');
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

}