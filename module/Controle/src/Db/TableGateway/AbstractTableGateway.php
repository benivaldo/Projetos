<?php

namespace Controle\Db\TableGateway;

use Controle\Model\AbstractModel;
use Zend\View\Model\JsonModel;
use Zend\Cache\StorageFactory;
use Zend\Paginator\Paginator;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterAwareInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Form\Annotation\Object;
use Zend\Db\Sql\Sql;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Adapter\Driver\ResultInterface;
use Interop\Container\ContainerInterface;
use Zend\Cache\Storage\Filesystem;

use Zend\Hydrator\Reflection;
abstract class AbstractTableGateway implements AdapterAwareInterface
{
    /**
     * Tablegateway
     * @var Object
     */
	protected $tableGateway;
	
	/**
	 * Nome da chave primaria
	 * @var string
	 */
	protected $primaryKey;
	
	/**
	 * nome da tabela
	 * @var string
	 */
	protected $tableName;
	
	/**
	 * 
	 * @var Object
	 */
	protected $cache;
	
	/**
	 * 
	 * @var Object
	 */
	protected $adapter;
	
	/**
	 * Model utilizado
	 * @var Object
	 */
	protected $model;
	
	/**
	 * Service locator
	 * @var Object
	 */
	
	protected $container;
	
	public function __construct(ContainerInterface $container)
	{
	    $this->container = $container;
	}
	

    public function setDbAdapter(Adapter $adapter)
    {
       $this->adapter = $adapter;
    }
    
    public function getDbAdapter()
    {
        return $this->adapter;
    }
	
	public function getTableGateway()
	{
	    $resultSetPrototype = new ResultSet();
	    $resultSetPrototype->setArrayObjectPrototype($this->getModel());
	    return new TableGateway($this->getTableName(), $this->getDbAdapter(), null, $resultSetPrototype);
	}
	
	/*public function setCache(StorageInterface $cache)
	{
		$this->cache = $cache;
	}*/
	
	/**
	 * Função para retornar os dados de uma tabela com ordenação por colunas e filtro por colunas e data
	 * @param string $paginated
	 * @param integer $page
	 * @param number $itemsPerPage
	 * @param string $orderBy
	 * @param string $order
	 * @param array $searchFrase  //array contendo (array[coluna] => frase)
	 * @param array $searchDate   //array contendo (array['date_create'] => data_ini/data_fin)
	 * @param array$inner  // array contendo ('table':nome da tabela inner, 'join':colunas do join, 'tipoJoin':tipo de join, 
	 * 'columns':colunas retornadas), podem ser exibidas com alias Ex. 'coluna' =>array('alias' => 'nome')
	 * @param string $query
	 * @param $colDataPesq //nome da coluna do campo data a ser pesquisado
	 * @param $colunas  //colunas a serem exibidas na query principal, podem ser exibidas com alias Ex. 'coluna' =>array('alias' => 'nome')
	 * @param $whereCampo Colunas com os campos a serem pesquisados
	 * @param $groupBy Colunas a serem agupadas
	 * @return \Zend\Paginator\Paginator|\Zend\Db\ResultSet\ResultSet
	 */
	public function fetchAll(
	    $paginated = false, 
        $page, 
	    $itemsPerPage = 10,
        $orderBy,
        $order,
        $searchFrase,
        $searchDate,
	    $inner,
	    $query = '',
	    $colDataPesq,
	    $colunas = array(),
	    $whereCampo = array(),
	    $groupBy = array()
    ) {
        $sql = new Sql($this->getTableGateway()->getAdapter());    

	    $select = $sql->select();	   

        if (!empty($query)) {
	        $select->setSpecification('select', $query);
	    }
	    
	    if (empty($query)) {
            $select->from($this->getTableGateway()->getTable());
            
            /*Seleciona colunas a serem exibidas*/
            if (count($colunas) > 0) {
                $select->columns($colunas);
            } 
           
            /*Adiciona Inner ao select*/
            if (count($inner) > 0) {
                foreach ($inner as $join) {
                    $select->join($join['table'], $join['join'], $join['columns'], $join['tipoJoin']); 
                }
            }

            /*Faz pesquisa dado uma coluna  um valor*/
            if (count($whereCampo) > 0) {
                $select->where($whereCampo);
            }
            
            /*Faz a busca no banco pela data se informado o campo data*/
            if (count($searchDate) > 0) {  
    	        $select->where($this->getWhereDate($searchDate, $colDataPesq));
    	    } 
    	    
    	    /*Faz a busca no banco pela frase se informado o campo busca*/
    	    if (count($searchFrase) > 0) {	        
    	        $select->where(array(
                    new \Zend\Db\Sql\Predicate\PredicateSet(                         
                         $this->getWhereFrase($searchFrase),
                        \Zend\Db\Sql\Predicate\PredicateSet::COMBINED_BY_OR
                    )
                ));
    	    }
    	    
    	    /** Colunas a serem agrupadas **/
    	    if (count($groupBy) > 0) {
    	        $select->group($groupBy);
    	    }
    	    
    	    /*Ordena por coluna*/
    	    if (isset($orderBy) && !empty($orderBy)) {
    	       $select->order("$orderBy $order"); 
    	    }
	    }    
	    //echo $select->getSqlString(); //Para Debug printa a query
	    
	    $statement = $sql->prepareStatementForSqlObject($select);
	    $result = $statement->execute();
	    if ($result instanceof ResultInterface) {
	        $hydrator     = new Reflection();
	        $rowPrototype = new $this->model();
	        $resultSet    = new HydratingResultSet($hydrator, $rowPrototype);
	        $resultSet->initialize($result);	    
	    }
	    $resultSet = new ResultSet();
	    $resultSet->initialize($result);
		 
		if ($paginated) {
            //$cache =  $this->container->get('Zend\Cache\Storage\Filesystem');
		    $cache = StorageFactory::factory(array(
		        'adapter' => array(
		            'name' => 'filesystem',
		            'options' => array(
		                'ttl'       => 3600,
                        'cache_dir' => './data/cache',
		            ),
		        ),
		        'plugins' => array('serializer'),
		    ));
            
		   Paginator::setCache($cache);
		    
			$dbTableGatewayAdapter = new DbSelect($select, $sql, $resultSet);
			$paginator = new Paginator($dbTableGatewayAdapter);
			$paginator->setCurrentPageNumber($page)
    			->setItemCountPerPage($itemsPerPage)
    			->setPageRange(20);
			return $paginator;
		} else {
			return $resultSet;
		}
	}

	/**
	 * Retorna subquery contendo pesquisa pelo campo data
	 * @param array $searchDate
	 * @return \Zend\Db\Sql\Predicate\Expression
	 */
	private function getWhereDate($searchDate, $colDataPesq)
	{
	    $nomeColuna = $colDataPesq;
	    	     
	    foreach ($searchDate as $coluna => $date) {
	        $nomeColuna = $coluna;
	        foreach ($date as $key => $val) {
	            $pesquisa[] = $val;
	        }
	    }
	     
	    if (count($pesquisa) == 2) {
	        $datePesquisa = new \Zend\Db\Sql\Predicate\Expression("$colDataPesq between '" . $pesquisa[0] . "' and '" . $pesquisa[1] . "'");
	    }
	    return $datePesquisa;
	}
	
	/**
	 * Retorna subquery pelo nome da coluna
	 * @param array $searchFrase
	 * @return \Zend\Db\Sql\Predicate\Expression
	 */
	private function getWhereFrase($searchFrase)
	{
	    /*Campos para as colunas do banco*/
	    foreach ($searchFrase as $key => $val) {
	        switch ($key) {
	            default:
	                $search[] = new \Zend\Db\Sql\Predicate\Expression("CAST(" . $key . " AS CHARACTER VARYING) ilike '%$val%'");
	                break;
	            /*Para chave primária converter em caracter para efetura pesquisa*/
	            case "" . $this->getPrimaryKey() . "":
	                $search[] = new \Zend\Db\Sql\Predicate\Expression( "CAST(" . $this->getTableName() . "." . $this->getPrimaryKey() . " AS CHARACTER VARYING) like '%$val%'" );
	                break;
	        }
	    }
	     return $search;
	}

	/**
	 * Retorna dados de uma tabela a partir de uma chave
	 * @param integer $key
	 * @throws \Exception
	 * @return mixed
	 */
	public function get($key) 
	{
		$key = (int) $key;
		$rowset = $this->getTableGateway()->select(array($this->getPrimaryKey() => $key));
		$row = $rowset->current();

		if (!$row) {
			throw new \Exception("Não encontrou o registro $key");
		}
		return $row;
	}

	/**
	 * Salva dados em uma tabela
	 * @param AbstractModel $model
	 * @return \Zend\View\Model\JsonModel
	 */
	public function save(AbstractModel $model) 
	{  
		$data = $model->toArray();
		$key = '';
		$erro = '';
		
		if (isset($data[$this->getPrimaryKey()])) {
			$key = $data[$this->getPrimaryKey()];
		}
		if ($key == '') {
		    unset($data[$this->getPrimaryKey()]); //Remover chave primaria na inclusão
		    try {
                $this->getTableGateway()->insert($data);

                $sequencia = $this->getNomeSequencia($this->getTableName(), $this->getPrimaryKey());

                $key = $this->getTableGateway()->getAdapter()->getDriver()->getLastGeneratedValue($sequencia['sequencia']);
                
                $erro = 'Operação efetuada com sucesso';
		    }catch (\Exception $e) {
		        $erro =  $e->getMessage();
		    }finally {
                return array('id' => $key, 'erro' =>  $erro );
            }
		}else {
			if ($this->get($key)) {
			    try {
                    $this->getTableGateway()->update($data, array($this->getPrimaryKey() => $key));
			        
                    $erro = 'Operação efetuada com sucesso';
			    }catch (\Exception $e) {
			        $erro =  $e->getMessage();
			    }finally {
			        return array('id' => $key, 'erro' => $erro);
			    }				
			} else {
			    return array('id' => $key, 'erro' => 'Registro não existe');
			}
		}
	}

	/**
	 * Exclui dados de uma tabela
	 * @param integer $key
	 */
    public function delete($key) 
	{
		$this->getTableGateway()->delete(array($this->getPrimaryKey() => $key));
	}

	/**
	 * Retorna nome da chave primaria
	 */
	public function getPrimaryKey()
	{
		return $this->primaryKey;
	}
	
	/**
	 * Retorna nome da tabela
	 */
	public function getTableName()
	{
	    return $this->tableName;
	}
	
	/**
	 * Retorna nome do Model
	 */
	public function getModel()
	{
	    return $this->model;
	}
	
	/**
	 * Retorna o nome da sequencia a ser indicados a tabela e a coluna
	 * @param string $table
	 * @param string $coluna
	 * @return mixed
	 */
	public  function getNomeSequencia($table, $coluna)
	{
	    $query = "select pg_get_serial_sequence('$table', '$coluna') as sequencia";
	    
	    $statement = $this->getTableGateway()->getAdapter()->createStatement($query);
        $result = $statement->execute();
        return $result->current();
	}

}