<?php

namespace Controle;

use Controle\Factory\AbstractControllerFactory;
use Controle\Factory\AbstractModelFactory;
use Controle\Factory\AbstractMapperFactory;
use Controle\Factory\AbstractServiceFactory;
use Controle\Factory\GetOptionsFactory;
use Controle\View\Helper\GetSelectOptions;
use Controle\Factory\GetContainerFactory;
use Controle\Db\TableGateway\AbstractTableGateway;


return [
    'controllers' => [
        'abstract_factories' => [
            AbstractControllerFactory::class,
        ]
    ],
      
    'service_manager' => [
        'abstract_factories' => [
            AbstractModelFactory::class,
            AbstractMapperFactory::class,
            AbstractServiceFactory::class,
        ],
        'factories' => [
            \Zend\I18n\Translator\TranslatorInterface::class => \Zend\I18n\Translator\TranslatorServiceFactory::class,
           // AbstractTableGateway::class => GetContainerFactory::class,
        ],//
    ],

    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy'
        ],
    ],
    
    'controller_plugins' => array(
        'invokables' => array(
            'saveModel' => 'Controle\Controller\Plugin\SaveModel',
            'deleteModel' => 'Controle\Controller\Plugin\DeleteModel'
        )
    ),
    
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    
    'view_helpers' => array(
        'invokables'=> array(
            'translator' => \Zend\I18n\View\Helper\Translate::class,            
            'formata_data' => 'Controle\View\Helper\FormataData'
        ),
        'factories' => array(
             GetSelectOptions::class => GetOptionsFactory::class,
        ),
        'aliases' => array(
            'options_sel' => GetSelectOptions::class,
        )
    ),
];
