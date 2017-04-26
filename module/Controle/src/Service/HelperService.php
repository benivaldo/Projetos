<?php
namespace Controle\Service;

class HelperService
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    protected $entityManager;
    protected $container;
    
    public function __construct($entityManager, $container)
    {
        $this->entityManager = $entityManager;
        $this->container = $container;
    }    

	/**
	 * Formata Cpf ou Cnpj
	 * @param string $numero
	 * @return string|NULL
	 */
	public function formataCpfCnpj($numero)
	{
	    // limpar tudo que não for digito
	    $numero = preg_replace('/[^0-9]/', '', trim($numero));
	    if(strlen($numero) == 11) {
	        // formata cpf
	        $cpf_formatado = substr($numero, 0, 3) . '.';
	        $cpf_formatado .= substr($numero, 3, 3) . '.';
	        $cpf_formatado .= substr($numero, 6, 3) . '-';
	        $cpf_formatado .= substr($numero, 9, 3);
	        
	        return $cpf_formatado;	         
	    } else if(strlen($numero) == 14) {
	        // formata cnpj
	        $cnpj_formatado = substr($numero, 0, 2) . '.';
	        $cnpj_formatado .= substr($numero, 2, 3) . '.';
	        $cnpj_formatado .= substr($numero, 5, 3) . '/';
	        $cnpj_formatado .= substr($numero, 8, 4) . '-';
	        $cnpj_formatado .= substr($numero, 12, 2);
	        
	        return $cnpj_formatado;
	    } else {
	        // quantidade de numeros inválidos para cpf ou cnpj
	        return null;
	    }
	}
	
	/**
	 * Formata data
	 * @param string $data
	 * @return string
	 */
	public function formataData($data)
	{
	    $dados = explode("-", $data);
	     
	    return $dados[2] . "/" . $dados[1] . "/" . $dados[0];
	}
}