<?php
namespace Sac;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Zend\ServiceManager\Factory\InvokableFactory;

return array(
    'controllers' => array(
        'factories' => array(
      		//Controller\IndexController::class  => InvokableFactory::class,
        	Controller\ChamadosController::class => Controller\Factory\ChamadosControllerFactory::class,
        ),
        
        'aliases' => [
            'chamados' => Controller\ChamadosController::class,
        ]
    ),
    
    'router' => array(
        'routes' => array(
             'sac' => array(
                'type'    => Literal::class ,
                'options' => array(
                    'route'    => '/sac',
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
                                'controller'    => Controller\ChamadosController::class,
                                'action'        => 'index',
                                'order' => 'ASC',
                                'page' => 1,
                                'search_frase' => '',
                              ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    
   
    'view_manager' => array(

        'template_path_stack' => array(
            'sac' => __DIR__ . '/../view',            
        ),
        'strategies' => array(
    		'ViewJsonStrategy',
        ),
    ),
   
	'doctrine' => [
		'driver' => [
			__NAMESPACE__ . '_driver' => [
				'class' => AnnotationDriver::class,
				'cache' => 'array',
				'paths' => [__DIR__ . '/../src/Entity']
			],
			'orm_default' => [
				'drivers' => [
					__NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
				]
			]
		]
	]
);