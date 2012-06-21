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
            
            // Set Gedmo tree subscriber
            'orm_evm' => array(
                'parameters' => array(
                    'opts' => array(
                        'subscribers' => array('Gedmo\Tree\TreeListener')
                    )
                )
            ),
        ),
    ),
);
