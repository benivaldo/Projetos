<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;
use Zend\Authentication\AuthenticationService;
use Zend\Validator\AbstractValidator;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
       //Cria o translator
        $translator = new \Zend\Mvc\I18n\Translator(new \Zend\I18n\Translator\Translator());
        $translator->addTranslationFile(
            './vendor/zendframework/zend-i18n-resources/languages/pt_BR/Zend_Validate.php',
            'default',
            'pt_BR'
        );
        AbstractValidator::setDefaultTranslator($translator);
    }

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'factories'=>array(
                'Application\Model\MyAuthStorage' => function($sm){
                    return new \Application\Model\MyAuthStorage('zf_tutorial');
                },
                'AuthService' => function($sm) {
                            //My assumption, you've alredy set dbAdapter
                            //and has users table with columns : user_name and pass_word
                            //that password hashed with md5
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $dbTableAuthAdapter  = new DbTableAuthAdapter($dbAdapter,
                        #'users','username','password', 'MD5(?)');
                        'users','username','password');

                    $authService = new AuthenticationService();
                    $authService->setAdapter($dbTableAuthAdapter);
                    $authService->setStorage($sm->get('Application\Model\MyAuthStorage'));

                    return $authService;
                },
            ),
        );
    }
}
