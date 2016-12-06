<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'CadParceiro\Controller\CadFornecedor' => 'CadParceiro\Controller\CadFornecedorController',
        ),
    ),
    
    'router' => array(
        'routes' => array(
             'cadparceiro' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/cadparceiro',
                    'defaults' => array(
                        '__NAMESPACE__' => 'CadParceiro\Controller',
                        'controller'    => 'CadFornecedor',
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
                                '__NAMESPACE__' => 'CadParceiro\Controller',
                                'controller'    => 'Cadfornecedor',
                                'action'        => 'index',
                                'order_by'      => 'fornecedor_id',
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
            'cadfornecedor' => __DIR__ . '/../view',
        ),
        'strategies' => array(
    		'ViewJsonStrategy',
        ),
    ),
   
);