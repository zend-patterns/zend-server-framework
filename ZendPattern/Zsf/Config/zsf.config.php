<?php
use ZendPattern\Zsf\Server\ZendServerManager;
use ZendPattern\Zsf\Feature\FeatureSet;
use ZendPattern\Zsf\Server\Configurator;
use ZendPattern\Zsf\Api\XmlMapper;
return array(
	'service_manager' => array(
		'factories' => array(
			ZendServerManager::SERVICE_KEY => 'ZendPattern\Zsf\Server\ZendServerManagerFactory',
			XmlMapper::SERVICE_KEY => 'ZendPattern\Zsf\Api\XmlMapperFactory',
		),
		'abstractFactories' => array(
			'ZendPattern\Zsf\Api\Service\ApiServiceAbstractFactory',
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
		
	XmlMapper::CONFIG_KEY => array(
		'services' => array(
			'collectionMarkups' => array(
				'notifications' => 'notification',
				'extensions' => 'extenson',
				'jobs' => 'job',
			),
		),
		'invokables' => array(
			'model::notification' => 'ZendPattern\Zsf\Model\Status\Notification',
			'hydrator::notification' => 'ZendPattern\Zsf\Api\XmlHydrator\NotificationHydrator',
			'model::extension' => 'ZendPattern\Zsf\Model\Configuration\Extension',
			'hydrator::extension' => 'ZendPattern\Zsf\Api\XmlHydrator\ExtensionHydrator',
			'model::job' => 'ZendPattern\Zsf\Model\Job\Job',
			'hydrator::job' => 'ZendPattern\Zsf\Api\XmlHydrator\JobHydrator',
			'model::jobInfo' => 'ZendPattern\Zsf\Model\Job\JobInfo',
			'hydrator::jobInfo' => 'ZendPattern\Zsf\Api\XmlHydrator\JobInfoHydrator',
		),
		'abstract_factories' => array(
			'ZendPattern\Zsf\Api\XmlHydrator\CollectionHydratorAbstractFactory',
		),
		'initializers' => array(
			'ZendPattern\Zsf\Api\XmlHydrator\XmlMapperInjector',
		),
	),
);