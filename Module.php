<?php

namespace SlmCmfKernelDoctrineOrm;

use Zend\ModuleManager\Feature;
use Zend\EventManager\Event;

class Module implements
    Feature\AutoloaderProviderInterface,
    //Feature\ServiceProviderInterface,
    Feature\ConfigProviderInterface,
    Feature\BootstrapListenerInterface
{    
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
//    public function getServiceConfiguration()
//    {
//        return include __DIR__ . '/config/services.config.php';
//    }
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function onBootstrap(Event $e)
    {
        $app = $e->getParam('application');
        $sm  = $app->getServiceManager();
        $em  = $app->events()->getSharedManager();
        
        /**
         * @todo Put listeners in a separate class, this is just for ease of prototyping 
         */
        $em->attach('SlmCmfKernel', 'getPageCollection', function (Event $e) use ($sm) {
            $repository = $sm->get('di')->get('doctrine_em')->getRepository('SlmCmfKernelDoctrineOrm\Entity\Page');
            
            $pages      = $repository->getRootNodes();
            $collection = new \SlmCmfKernel\Model\PageCollection($pages);
            
            return $collection;
        });
        
        $em->attach('SlmCmfKernel', 'loadPage', function (Event $e) use ($sm) {
            $repository = $sm->get('di')->get('doctrine_em')->getRepository('SlmCmfKernelDoctrineOrm\Entity\Page');
            
            $id   = $e->getParam('page-id');
            $page = $repository->find($id);
            
            return $page;
        });
        
        
    }
}
