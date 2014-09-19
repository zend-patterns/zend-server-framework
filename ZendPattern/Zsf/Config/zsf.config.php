<?php
use ZendPattern\Zsf\Server\ZendServerManager;
use ZendPattern\Zsf\Feature\FeatureSet;
use ZendPattern\Zsf\Server\Configurator;
return array(
	'service_manager' => array(
		'factories' => array(
			ZendServerManager::SERVICE_KEY => 'ZendPattern\Zsf\Server\ZendServerManagerFactory',
		),
	),
	ZendServerManager::CONFIG_KEY => array(
		'invokables' => array(
			Configurator::SERVICE_KEY => 'ZendPattern\Zsf\Server\Configurator',
		),
	    'factories' => array(
		    FeatureSet::SERVICE_KEY => 'ZendPattern\Zsf\Feature\FeatureSetFactory',
	    ),
	    'abstract_factories' => array(
	    	'ZendPattern\Zsf\Server\ZendServerAbstractFactory',
	    ),
	),
);