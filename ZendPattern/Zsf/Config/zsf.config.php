<?php
return array(
	'service_manager' => array(
		'invokables' => array(
			'Zsf\ZendServerConfigurator' => 'ZendPattern\Zsf\Server\Configurator',
		),
	    'factories' => array(
		    'Zsf\FeatureSet' => 'ZendPattern\Zsf\Feature\FeatureSetFactory',
	    ),
	    'abstract_factories' => array(
	    	'ZendPattern\Zsf\Server\ZendServerAbstractFactory',
	    ),
	),
);