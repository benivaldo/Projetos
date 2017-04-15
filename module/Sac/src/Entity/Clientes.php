<?php
namespace Sac\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="clientes")
 */
class Clientes
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(name="id")
	 */
	protected $id;

	/**
	 * @ORM\Column(name="nome")
	 */
	protected $nome;
	
	/**
	 * @ORM\Column(name="email")
	*/
	protected $email;
	
		
	// Returns ID of this clientes.
	public function getId()
	{
		return $this->id;
	}
	
	// Sets ID of this chamados.
	public function setId($id)
	{
		$this->id = $id;
	}
	
	
	// Returns nome.
	public function getNome()
	{
		return $this->nome;
	}
	
	// Sets nome.
	public function setNome($nome)
	{
		$this->nome = $nome;
	}
	
	// Returns email.
	public function getEmail()
	{
		return $this->email;
	}
	
	// Sets nome.
	public function setEmail($email)
	{
		$this->email = $email;
	}

}