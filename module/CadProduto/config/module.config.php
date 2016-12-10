<?php
namespace CadProduto;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return array(
    'controllers' => array(
         'aliases' => [
            'cadproduto' => Controller\CadProdutoController::class,
            'cadean'     => Controller\CadEanController::class,
        ]
    ),
    
    'router' => array(
        'routes' => array(
             'cadproduto' => array(
                'type'    => Literal::class,
                'options' => array(
                    'route'    => '/cadproduto',
                    'defaults' => array(
 
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => Segment::class,
                        'options' => array(
                            'route' => "/[:controller[/:action][/id/:id][/page/:page][/:div][/order_by/:order_by][/:order][/search_frase/:search_frase][/data_ini/:data_ini][/data_fin/:data_fin]]",
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'page'   => '[0-9]+',
                                'id'     => '[0-9]+',
                                'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'order' => 'ASC|DESC',
                            ),
                            'defaults' => array(
                                'controller'    => Controller\CadProdutoController::class,
                                'action'        => 'index',
                                'order_by'      => 'produto_id',
                                'order' => 'ASC',
                                'page' => 1,
                                'search_frase' => '',
                            ),
                        ),
                    ),
                    'grid' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route' => "/[:grid]",
                            
                            'defaults' => array(
                                'action'        => 'grid'
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    
    
    'view_manager' => array(
        'template_path_stack' => array(
            'cadproduto' => __DIR__ . '/../view',
            'cadean' => __DIR__ . '/../view',
        ),
    ),
   
);