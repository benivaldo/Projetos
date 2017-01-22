<?php

namespace CadProduto\Controller;

use Controle\Controller\AbstractCrudController;
use CadProduto\Model\CadProduto;
use CadProduto\Form\CadProdutoForm;
use Zend\View\Model\ViewModel;
use CadProduto\Model\CadEan;

class CadProdutoController extends AbstractCrudController
{
    protected $albumTable;
    
    public function getVariaveis()
    {
    	$this->tableGatewayClass = 'CadProduto\Model\CadProdutoTable';
    	$this->form = new CadProdutoForm();
    	$this->model = new CadProduto();
    	$this->route = 'home';
    	$this->viewData = 'dados';
    	$this->pagination = true;
    	$this->template = 'cadproduto/cadproduto/index.phtml';
    	$this->div = '';
    	$this->primaryKey = null;
    	$this->searchFrase;
    	$this->searchDate;
    	$this->inner = [];
    	$this->campo = 'descricao';
    	$this->idTable = 'produto_id';
    	$this->colDataPesq = 'data_cadastro';
    	$this->whereCampo;
    	$this->colunas;
    	$this->order_by = 'produto_id';
    	$this->group_by;
    	$this->removeFromPost = array('sku',
    	    'ncm_cod',
    	    'ncm',
    	    'aliq_pis_entrada',
    	    'cst_pis_entrada',
    	    'aliq_pis_saida',
    	    'cst_pis_saida',
    	    "aliq_cofins_entrada",
    	    "cst_cofins_entrada",
    	    "aliq_cofins_saida",
    	    "cst_cofins_saida",
    	    "aliq_ipi_entrada",
    	    "cst_ipi_entrada",
    	    "aliq_ipi_saida",
    	    "cst_ipi_saida",
    	    "trib_pdv",
    	    "aliq_pdv",
    	    "reducao_base_entrada",
    	    "aliq_base_entrada",
    	    "reducao_base_saida",
    	    "aliq_base_saida",
    	);
    	$this->infoAdic = true;
     }

    public function indexAction()
    {
        $this->getVariaveis();
        
        $this->div = $this->params('div');
        
        /*Construção dos campos a serem pesquizados*/
        if (strlen($this->params('search_frase')) > 0) {
            if (is_numeric($this->params('search_frase'))) {
                $this->searchFrase['produto_id'] = $this->params('search_frase');
                
            }
            
            $this->searchFrase['descricao'] = strtolower($this->params('search_frase'));
            $this->searchFrase['desc_resumida'] = strtolower($this->params('search_frase')); 
            $this->searchFrase['plu'] = $this->params('search_frase');
        }
        
        /*Aqui será enviado os valores para a pesquisa por data*/
        if (strlen($this->params('data_ini')) > 0 || strlen($this->params('data_fin')) > 0) {
            $this->searchDate[$this->colDataPesq][] = $this->params('data_ini');
            $this->searchDate[$this->colDataPesq][] = $this->params('data_fin');
        }
        
        /*Aqui será enviado uma array contendo os tabelas/ colunas e um array com a tabela que fara o inner e um array para exibir as colunas*/
       // $this->inner[] = array( 'inner'=> array("produto" => 'plu', "sku" => 'plu',  "table" => 'sku', "join" => 'inner') , "columns" => array('sku'));
        
        $this->query = '';
        $divDados  = explode("_", $this->params('div'));
        //Verifica se a paginação, quando existe paginação o nome da div é dados_nome_aba 
        if($divDados[0] == 'dados'){
    	   $this->template = 'cadproduto/cadproduto/dados.phtml';
        }else{
            $this->template = 'cadproduto/cadproduto/index.phtml';
        }

    	return parent::indexAction();
    }

    public function editAction()
    {
        $this->getVariaveis();
        $this->inner = $this->getInner();
        
        $this->div = $this->params('div');
        $this->route = 'cadproduto/cadproduto/index';
        $this->template = 'cadproduto/cadproduto/edit.phtml';

        return parent::editAction();
    }
    
    public function addAction()
    {
        $this->getVariaveis();
        $this->inner = $this->getInner();
        
        $this->div = $this->params('div');
        $this->route = 'cadproduto/cadproduto/index';
        $this->template = 'cadproduto/cadproduto/add.phtml';
        
        //return parent::addAction();
        
        $form = $this->form;
        
        $request = $this->getRequest();
        
        if ($request->isPost() && count($request->getPost()) != 0) {
            $plu = $this->retornaPlu();
            $request->getPost()->set('plu', $plu);
            $sku = $this->params()->fromPost('sku');
        }
        
         $this->errorMessage = $this->saveModel()->save($this->model, $this->getTableGateway(), $form, $this->route, $this->removeFromPost );
        $pluId = $this->errorMessage['id'];
        if (is_numeric($pluId) && !empty($sku)) {
            $tableGatewayEan = $this->container->get('CadProduto\Model\CadEanTable');
            $ean = array(
                'sku' => $sku,
                'plu_id' => $pluId,
                'ativo' => true,
                'data_cadastro' => date('Y-m-d'),
            );
            $modelEan = new CadEan();
            $modelEan->exchangeArray($ean);
            $this->errorMessage = $tableGatewayEan->save($modelEan);
            $this->errorMessage['id'] = $pluId;   // Atribui novamente o id da tb_produto
        }
        
        if ($this->infoAdic == true) {
            $this->whereCampo = array($this->idTable => 0);
            $this->colunas  = array($this->idTable);
            parent::getAction();
        }
        
        $this->viewModel = new ViewModel(array ('form' => $form,
            'info' => $this->info->current(),
            'div' => $this->div,
        ));
        
        return parent::verificaAjaxJson($this->viewModel);
       
        
    	//return parent::addAction();
    }
    
    public function deleteAction()
    {
        $this->getVariaveis();
       
        return parent::deleteAction();
    }
    
    public function prevAction()
    {
        $this->getVariaveis();
        $this->inner = $this->getInner();
    
        $this->div = $this->params('div');
        $this->template = 'cadproduto/cadproduto/edit.phtml';
         
        $this->queryPrev = "select prev
            from (
            select  produto_id, descricao, data_cadastro,
            lag(produto_id) over (order by produto_id asc) as prev,
            lead(produto_id) over (order by produto_id asc) as next
            from cad_produto
            ) x
            where ? IN (produto_id)";
    
    
        return parent::prevAction();
    }
    
    public function nextAction()
    {
        $this->getVariaveis();
        $this->inner = $this->getInner();
    
        $this->div = $this->params('div');
        $this->template = 'cadproduto/cadproduto/edit.phtml';
    
        $this->queryNext = "select next
            from (
             select  produto_id, descricao, data_cadastro,
            lag(produto_id) over (order by produto_id asc) as prev,
            lead(produto_id) over (order by produto_id asc) as next
            from cad_produto
            ) x
            where ? IN (produto_id)";
    
         
        return parent::nextAction();
    }
    
    
    /**
     * Função para retornar o id posterior
     */
    private function retornaPlu($tipo = 'un')
    {
        $pluUnidade = "plu_unidade";
        $pluBalanca = "plu_balanca";
        
        $query = "SELECT NEXTVAL('$pluUnidade') as plu";
    
        $statement = $this->container->get('Zend\Db\Adapter\Adapter')->createStatement($query);
        $result = $statement->execute();
        $row = $result->current();
        
    
        return $row['plu'];
    }
    
    /**
     * Retorna dados de campos adicionais
     * {@inheritDoc}
     * @see \Controle\Controller\AbstractCrudController::indexAction()
     */
    public function getInner()
    {
        /*Aqui será enviado uma array contendo os tabelas/ colunas e um array com a tabela que fara o inner e um array para exibir as colunas*/
        $inner[] = array(
            "table"     => 'cad_icms',
            "join"   => 'cad_icms.icms_id = cad_produto.icms_pdv_id',
            "tipoJoin"      => 'inner',
            "columns" => array('trib_pdv' => 'cod_tributacao_pdv',
                "aliq_pdv" => 'aliquota')
        );
        
        $inner[] = array(
            "table"     => 'cad_ncm',
            "join"   => 'cad_ncm.ncm_id = cad_produto.ncm_id',
            "tipoJoin"      => 'inner',
            "columns" => array('ncm' => 'ncm',
                "ncm_cod" => 'codigo')
        );
        
    
        $inner[] = array(
            "table"     => array( 'icms2' => 'cad_icms'),
            "join"   => 'icms2.icms_id = cad_produto.icms_nf_entrada_id',
            "tipoJoin"      => 'inner',
            "columns" => array('reducao_base_entrada' => 'base',
                "aliq_base_entrada" => 'aliquota')
        );
        
        $inner[] = array(
            "table"     => array( 'icms3' => 'cad_icms'),
            "join"   => 'icms2.icms_id = cad_produto.icms_nf_saida_id',
            "tipoJoin"      => 'inner',
            "columns" => array('reducao_base_saida' => 'base',
                "aliq_base_saida" => 'aliquota')
        );
        
        $inner[] = array(
            "table"     => 'cad_ipi',
            "join"   => 'cad_ipi.ipi_id = cad_produto.ipi_entrada_id',
            "tipoJoin"      => 'left',
            "columns" => array('cst_ipi_entrada' => 'codigo',
                "aliq_ipi_entrada" => 'aliquota')
        );
        
        $inner[] = array(
            "table"     => array('ipi2' =>'cad_ipi'),
            "join"   => 'cad_ipi.ipi_id = cad_produto.ipi_saida_id',
            "tipoJoin"      => 'left',
            "columns" => array('cst_ipi_saida' => 'codigo',
                "aliq_ipi_saida" => 'aliquota')
        );
        
        $inner[] = array(
            "table"     => 'cad_pis',
            "join"   => 'cad_pis.pis_id = cad_produto.pis_entrada_id',
            "tipoJoin"      => 'left',
            "columns" => array('cst_pis_entrada' => 'codigo',
                "aliq_pis_entrada" => 'aliquota')
        );
        
        $inner[] = array(
            "table"     => ['pis2' => 'cad_pis'],
            "join"   => 'pis2.pis_id = cad_produto.pis_saida_id',
            "tipoJoin"      => 'left',
            "columns" => array('cst_pis_saida' => 'codigo',
                "aliq_pis_saida" => 'aliquota')
        );
        
        $inner[] = array(
            "table"     => 'cad_cofins',
            "join"   => 'cad_cofins.cofins_id = cad_produto.cofins_entrada_id',
            "tipoJoin"      => 'left',
            "columns" => array('cst_cofins_entrada' => 'codigo',
                "aliq_cofins_entrada" => 'aliquota')
        );
        
        $inner[] = array(
            "table"     => ['cofins2' => 'cad_cofins'],
            "join"   => 'cofins2.cofins_id = cad_produto.cofins_saida_id',
            "tipoJoin"      => 'left',
            "columns" => array('cst_cofins_saida' => 'codigo',
                "aliq_cofins_saida" => 'aliquota')
        );
        
        return $inner;
    }
    
    public function gridAction()
    {
        return parent::gridAction();
    }
    
}
