<?php
return array(
    'slmcmf_kernel' => array(
        'page_service_class' => 'SlmCmfKernelDoctrineOrm\Service\Page',
    ),
    
    'doctrine' => array(
        'driver' => array(
            'slm_cmf_kernel' => array(
                'paths' => array(__DIR__ . '/../src/SlmCmfKernelDoctrineOrm/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'SlmCmfKernelDoctrineOrm\Entity' => 'slm_cmf_kernel'
                )
            ),
        ),
        
        'eventmanager' => array(
            'orm_default' => array(
                'subscribers' => array('Gedmo\Tree\TreeListener')
            ),
        ),
    ),
);
