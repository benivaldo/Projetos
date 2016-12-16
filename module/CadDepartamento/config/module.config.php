<?php
namespace CadDepartamento;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;


return array(
    'controllers' => array(
        'factories' => array(
           //Controller\CadSecaoController::class  => InvokableFactory::class,
            //Controller\CadGrupoController::class => InvokableFactory::class,
            //Controller\CadSubGrupoController::class => InvokableFactory::class,
        ),
        
        'aliases' => [
            'cadsecao' => Controller\CadSecaoController::class,
            'cadgrupo' => Controller\CadGrupoController::class,
            'cadsubgrupo' => Controller\CadSubGrupoController::class,
        ]
    ),
    
    'router' => array(
        'routes' => array(
             'caddepartamento' => array(
                'type'    => Literal::class ,
                'options' => array(
                    'route'    => '/caddepartamento',
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
                                'controller'    => Controller\CadSecaoController::class,
                                'action'        => 'index',
                                'order_by'      => 'secao_id',
                                'order' => 'ASC',
                                'page' => 1,
                                'search_frase' => '',
                                'total_page' => 2
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    
      
    
    'view_manager' => array(

        'template_path_stack' => array(
            'caddepartamento' => __DIR__ . '/../view',
            'cadsecao' => __DIR__ . '/../view',
            'cadgrupo' => __DIR__ . '/../view',
            'cadsubgrupo' => __DIR__ . '/../view',
        ),
        'strategies' => array(
    		'ViewJsonStrategy',
        ),
    ),
   
);