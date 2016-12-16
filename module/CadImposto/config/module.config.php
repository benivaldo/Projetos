<?php
namespace CadImposto;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return array(
    'controllers' => array(
        'aliases' => [
            'cadcofins' => Controller\CadCofinsController::class,
            'cadicms'   => Controller\CadIcmsController::class,
            'cadipi'    => Controller\CadIpiController::class,
            'cadncm'    => Controller\CadNcmController::class,
            'cadpis'    => Controller\CadPisController::class,
        ]
    ),
    
    'router' => array(
        'routes' => array(
             'cadimposto' => array(
                'type'    => Literal::class ,
                'options' => array(
                    'route'    => '/cadimposto',
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
                                'controller'    => Controller\CadNcmController::class,
                                'action'        => 'index',
                                'order' => 'ASC',
                                'page' => 1,
                                'search_frase' => '',
                                'total_page' => 2 // Para testes de paginação, retirar em produção
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
            'cadncm' => __DIR__ . '/../view',
            'cadicms' => __DIR__ . '/../view',
            'cadpis' => __DIR__ . '/../view',
            'cadcofins' => __DIR__ . '/../view',
            'cadipi' => __DIR__ . '/../view',
        ),
    ),
   
);