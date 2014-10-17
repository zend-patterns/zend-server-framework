<?php
use ZendPattern\Zsf\Feature\FeatureSet;
return array(
	FeatureSet::CONFIG_KEY => array(
		'invokables' => array(
			'status'    => 'ZendPattern\Zsf\Feature\Common\Status',
			'createJob' => 'ZendPattern\Zsf\JobQueue\Feature\CreateJob',
			'eventDispatcher' =>'ZendPattern\Zsf\Feature\Common\EventDispatcher\EventDispatcher',
			'bootstrap' => 'ZendPattern\Zsf\Feature\Common\Bootstrap',
			'eventDispacther' => 'ZendPattern\Zsf\Feature\Common\EventDispatcher\EventDispatcher',
			'featureCallDispatcher' => 'ZendPattern\Zsf\Feature\Common\EventDispatcher\FeatureCallDispatcher',
			'configuration' => 'ZendPattern\Zsf\Configuration\Feature\Configuration',
			'autoDiscover' => 'ZendPattern\Zsf\Feature\Common\AutoDiscover',
			'autoDiscoverApiKeys' => 'ZendPattern\Zsf\Feature\Common\AutoDiscoverApiKeys', 
		),
		'factories' => array(
			'apiCall' => 'ZendPattern\Zsf\Api\ApiCallFactory',
			'publish'   => 'ZendPattern\Zsf\Message\Feature\PublishFactory',
		),
		'abstract_factories' => array(
			'ZendPattern\Zsf\Api\Service\ApiServiceAbstractFactory'
		),
	),
);