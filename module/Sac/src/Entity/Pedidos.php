<?php
namespace Sac\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="pedidos")
 */
class Pedidos
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(name="id")
	 */
	protected $id;

	/**
	 * @ORM\Column(name="descricao")
	 */
	protected $descricao;
	
	
	
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
	
	

}