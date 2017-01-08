<?php
namespace CadParceiro;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return array(
    'controllers' => array(
        'aliases' => [
            'cadfornecedor' => Controller\CadFornecedorController::class,
        ]
    ),
    
    'router' => array(
        'routes' => array(
             'cadparceiro' => array(
                'type'    => Literal::class,
                'options' => array(
                    'route'    => '/cadparceiro',
                    'defaults' => array(
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => Segment::class,
                        'options' => array(
                            'route' => "/[:controller[/:action][/id/:id][/page/:page][/:div][/order_by/:order_by][/:order][/search_frase/:search_frase][/data_ini/:data_ini][/data_fin/:data_fin][/tipo_view/:tipo_view]]",
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'page'   => '[0-9]+',
                                'id'     => '[0-9]+',
                                'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'order' => 'ASC|DESC',
                            ),
                            'defaults' => array(
                                'controller'    => Controller\CadFornecedorController::class,
                                'action'        => 'index',
                                'order' => 'ASC',
                                'page' => 1,
                                'search_frase' => '',
                                'total_page' => 1,
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
            'cadfornecedor' => __DIR__ . '/../view',
        ),
    ),
   
);