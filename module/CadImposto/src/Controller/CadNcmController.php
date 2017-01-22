<?php

namespace CadImposto\Controller;

use Controle\Controller\AbstractCrudController;
use CadImposto\Form\CadNcmForm;
use CadImposto\Model\CadNcm;

class CadNcmController extends AbstractCrudController
{
    protected $albumTable;
    
    public function getVariaveis()
    {
    	$this->tableGatewayClass = 'CadImposto\Model\CadNcmTable';
    	$this->form = new CadNcmForm();
    	$this->model = new CadNcm();
    	$this->route = 'home';
    	$this->viewData = 'dados';
    	$this->pagination = true;
    	$this->template = 'cadimposto/cadncm/index.phtml';
    	$this->div = '';
    	$this->primaryKey = null;
    	$this->searchFrase;
    	$this->searchDate;
    	$this->inner;
    	$this->campo = 'descricao';
    	$this->idTable = 'ncm_id';
    	$this->colDataPesq = 'data_cadastro';
    	$this->whereCampo;
    	$this->colunas;
    	$this->order_by = 'ncm_id';
    	$this->group_by;
     }

    public function indexAction()
    {
        $this->getVariaveis();
        
        $this->div = $this->params('div');
        
        /*Construção dos campos a serem pesquizados*/
        if (strlen($this->params('search_frase')) > 0) {
            if (is_numeric($this->params('search_frase'))) {
                $this->searchFrase['ncm_id'] = $this->params('search_frase');
            }
            $this->searchFrase['codigo'] = strtolower($this->params('search_frase'));
            $this->searchFrase['descricao'] = strtolower($this->params('search_frase'));
        }
        /*Aqui será enviado os valores para a pesquisa por data*/
        if (strlen($this->params('data_ini')) > 0 || strlen($this->params('data_fin')) > 0) {
            $this->searchDate[$this->colDataPesq][] = $this->params('data_ini');
            $this->searchDate[$this->colDataPesq][] = $this->params('data_fin');
        }
        
        /*Aqui será enviado uma array contendo os tabelas/ colunas e um array com a tabela que fara o inner e um array para exibir as colunas*/
        //$this->inner[] = array( 'inner'=> array("album" => 'genreid', "genre" => 'id',  "table" => 'genre', "join" => 'inner') , "columns" => array('genre'));
        
        $this->query = '';
        $divDados  = explode("_", $this->params('div'));
        //Verifica se a paginação, quando existe paginação o nome da div é dados_nome_aba 
        if($divDados[0] == 'dados'){
    	   $this->template = 'cadimposto/cadncm/dados.phtml';
        }else{
            $this->template = 'cadimposto/cadncm/index.phtml';
        }

    	return parent::indexAction();
    }

    public function editAction()
    {
        $this->getVariaveis();
        
        $this->div = $this->params('div');
        $this->route = 'cadimposto/cadncm/index';
        $this->template = 'cadimposto/cadncm/edit.phtml';
        return parent::editAction();
    }
    
    public function addAction()
    {
        $this->getVariaveis();
        $this->div = $this->params('div');
        $this->route = 'cadimposto/cadncm/index';
        $this->template = 'cadimposto/cadncm/add.phtml';
    	return parent::addAction();
    }
    
    public function deleteAction()
    {
        $this->getVariaveis();
        
        return parent::deleteAction();
    }
    
    public function prevAction()
    {
        $this->getVariaveis();
        $this->div = $this->params('div');
        $this->template = 'cadimposto/cadncm/edit.phtml';
         
        $this->queryPrev = "select prev
            from (
            select  ncm_id, descricao, data_cadastro,
            lag(ncm_id) over (order by ncm_id asc) as prev,
            lead(ncm_id) over (order by ncm_id asc) as next
            from cad_ncm
            ) x
            where ? IN (ncm_id)";
    
    
        return parent::prevAction();
    }
    
    public function nextAction()
    {
        $this->getVariaveis();
        $this->div = $this->params('div');
        $this->template = 'cadimposto/cadncm/edit.phtml';
    
        $this->queryNext = "select next
            from (
            select  ncm_id, descricao, data_cadastro,
            lag(ncm_id) over (order by ncm_id asc) as prev,
            lead(ncm_id) over (order by ncm_id asc) as next
            from cad_ncm
            ) x
            where ? IN (ncm_id);";
         
        return parent::nextAction();
    }
    
    /**
     * Retorna dados de impostos no retorno do ncm
     * {@inheritDoc}
     * @see \Controle\Controller\AbstractCrudController::indexAction()
     */
    public function getAction()
    {
        $this->getVariaveis();
        
        $this->whereCampo = array($this->idTable => $this->params('id'));
        $this->colunas  = array($this->idTable,'ncm','ncm_cod'=> 'codigo');
    
        /*Aqui será enviado uma array contendo os tabelas/ colunas e um array com a tabela que fara o inner e um array para exibir as colunas*/

        $this->inner[] = array(
            "table"     => ['pdv' =>'cad_icms'],
            "join"   => 'pdv.icms_id = cad_ncm.icms_pdv_id',
            "tipoJoin"      => 'inner',
            "columns" => array('icms_pdv_id' =>'icms_id',
                'trib_pdv' => 'cod_tributacao_pdv',
                "aliq_pdv" => 'aliquota')
        );        
   
        $this->inner[] = array(
            "table"     => array( 'entrada' => 'cad_icms'),
            "join"   => 'entrada.icms_id = cad_ncm.icms_nf_entrada_id',
            "tipoJoin"      => 'inner',
            "columns" => array('icms_nf_entrada_id' => 'icms_id',
                'reducao_base_entrada' => 'base',
                "aliq_base_entrada" => 'aliquota')
        );
        
        $this->inner[] = array(
            "table"     => ['saida' => 'cad_icms'],
            "join"   => 'saida.icms_id = cad_ncm.icms_nf_saida_id',
            "tipoJoin"      => 'inner',
            "columns" => array('icms_nf_saida_id' => 'icms_id',
                'reducao_base_saida' => 'base',
                "aliq_base_saida" => 'aliquota')
        );
        
        $this->inner[] = array(
            "table"     => ['ipi_entrada' => 'cad_ipi'],
            "join"   => 'ipi_entrada.ipi_id = cad_ncm.ipi_entrada_id',
            "tipoJoin"      => 'left',
            "columns" => array('ipi_entrada_id' => 'ipi_id',
                'cst_ipi_entrada' => 'codigo',
                "aliq_ipi_entrada" => 'aliquota')
        );
        
        $this->inner[] = array(
            "table"     => array('ipi_saida' =>'cad_ipi'),
            "join"   => 'ipi_saida.ipi_id = cad_ncm.ipi_saida_id',
            "tipoJoin"      => 'left',
            "columns" => array('ipi_saida_id' => 'ipi_id',
                'cst_ipi_saida' => 'codigo',
                "aliq_ipi_saida" => 'aliquota')
        );
        
        $this->inner[] = array(
            "table"     => ['pis_entrada' => 'cad_pis'],
            "join"   => 'pis_entrada.pis_id = cad_ncm.pis_entrada_id',
            "tipoJoin"      => 'left',
            "columns" => array('pis_entrada_id' => 'pis_id',
                'cst_pis_entrada' => 'codigo',
                "aliq_pis_entrada" => 'aliquota')
        );
        
        $this->inner[] = array(
            "table"     => ['pis_saida' => 'cad_pis'],
            "join"   => 'pis_saida.pis_id = cad_ncm.pis_saida_id',
            "tipoJoin"      => 'left',
            "columns" => array('pis_saida_id' => 'pis_id',
                'cst_pis_saida' => 'codigo',
                "aliq_pis_saida" => 'aliquota')
        );
        
        $this->inner[] = array(
            "table"     => ['cofins_entrada' => 'cad_cofins'],
            "join"   => 'cofins_entrada.cofins_id = cad_ncm.cofins_entrada_id',
            "tipoJoin"      => 'left',
            "columns" => array('cofins_entrada_id' => 'cofins_id',
                'cst_cofins_entrada' => 'codigo',
                "aliq_cofins_entrada" => 'aliquota')
        );
        
        $this->inner[] = array(
            "table"     => ['cofins_saida' => 'cad_cofins'],
            "join"   => 'cofins_saida.cofins_id = cad_ncm.cofins_saida_id',
            "tipoJoin"      => 'left',
            "columns" => array('cofins_saida_id' => 'cofins_id',
                'cst_cofins_saida' => 'codigo',
                "aliq_cofins_saida" => 'aliquota')
        );
    
    
        return parent::getAction();
    }
    
    public function gridAction()
    {
        return parent::gridAction();
    }
    
}
