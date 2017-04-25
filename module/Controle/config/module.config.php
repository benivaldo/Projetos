<?php

namespace Controle;

use Controle\Controller\Factory\AbstractControllerFactory;
use Controle\Factory\ControleFormFactory;
use Controle\Service\Factory\ControleServiceFactory;
use Controle\Service\ControleService;
use Controle\Factory\InstanceServiceFactory;
use Controle\View\Helper\FunctionsHelper;
use Controle\View\Helper\Factory\FunctionsHelperFactory;
use Controle\Service\HelperService;
use Controle\Service\Factory\HelperServiceFactory;


return [
    'controllers' => [
        'abstract_factories' => [
            AbstractControllerFactory::class,
        ]
    ],
      
    'service_manager' => [
        'abstract_factories' => [
            //AbstractModelFactory::class,
           // AbstractMapperFactory::class,
           // AbstractServiceFactory::class,
            InstanceServiceFactory::class,
        ],
        'factories' => [
            \Zend\I18n\Translator\TranslatorInterface::class => \Zend\I18n\Translator\TranslatorServiceFactory::class,
            ControleService::class => ControleServiceFactory::class,
            HelperService::class => HelperServiceFactory::class,
        ],
    ],

    'form_elements' => array(
        'factories' => array(
            //ChamadosForm::class => ChamadosFormFactory::class,
        ),
        'abstract_factories' => array(
            ControleFormFactory::class,           
        ),
    ),
    
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
            FunctionsHelper::class => FunctionsHelperFactory::class,
        ),
        'aliases' => array(
            'funcoes' => FunctionsHelper::class,
        )
    ),
];
