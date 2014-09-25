<?php
use ZendPattern\Zsf\Feature\FeatureSet;
return array(
	FeatureSet::CONFIG_KEY => array(
		'invokables' => array(
			'status'  => 'ZendPattern\Zsf\Feature\Common\Status',
			'createJob' => 'ZendPattern\Zsf\JobQueue\Feature\CreateJob',
			'eventDispatcher' =>'ZendPattern\Zsf\Feature\Common\EventDispatcher\EventDispatcher',
			'bootstrap' => 'ZendPattern\Zsf\Feature\Common\Bootstrap',
			//'featureCallDispatcher' => 'ZendPattern\Zsf\Feature\Common\EventDispatcher\FeatureCallDispatcher',
			//'autoDiscover' => 'ZendPattern\Zsf\Feature\Common\Bootstrap',
		),
		'factories' => array(
			'apiCall' => 'ZendPattern\Zsf\Api\ApiCallFactory',
		),
		'abstract_factories' => array(
			'ZendPattern\Zsf\Api\Service\ApiServiceAbstractFactory'
		),
	),
);