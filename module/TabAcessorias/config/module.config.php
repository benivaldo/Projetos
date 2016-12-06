<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'TabAcessorias\Controller\TabCidades' => 'TabAcessorias\Controller\TabCidadesController',
        ),
    ),
    
    'router' => array(
        'routes' => array(
             'tabacessorias' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/tabacessorias',
                    'defaults' => array(
                        '__NAMESPACE__' => 'TabAcessorias\Controller',
                        'controller'    => 'TabCidades',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
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
                                '__NAMESPACE__' => 'TabAcessorias\Controller',
                                'controller'    => 'TabCidades',
                                'action'        => 'index',
                                'order_by'      => '',
                                'order' => 'ASC',
                                'page' => 1,
                                'search_frase' => '',
                                'total_page' => 2
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
    

    'controller_plugins' => array(
		'invokables' => array(
			'saveModel' => 'Controle\Controller\Plugin\SaveModel',
	        'deleteModel' => 'Controle\Controller\Plugin\DeleteModel'
		)
    ),
    
    'view_helpers' => array(
        'invokables'=> array(
            'options_sel' => 'Controle\View\Helper\GetSelectOptions',
            'formata_data' => 'Controle\View\Helper\FormataData'
        )
    ),
    
    'view_manager' => array(
        'template_path_stack' => array(
            'tabacessorias' => __DIR__ . '/../view',
        ),
        'strategies' => array(
    		'ViewJsonStrategy',
        ),
    ),
   
);