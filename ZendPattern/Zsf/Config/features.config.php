<?php
return array(
	'Zsf\featureSet\Config' => array(
		'invokables' => array(
			'apiCall' => 'ZendPattern\Zsf\Api\ApiCall',
			//'featureCallDispatcher' => 'ZendPattern\Zsf\Feature\Common\EventDispatcher\FeatureCallDispatcher',
			'eventDispatcher' =>'ZendPattern\Zsf\Feature\Common\EventDispatcher\EventDispatcher',
			'bootstrap' => 'ZendPattern\Zsf\Feature\Common\Bootstrap',
			//'autoDiscover' => 'ZendPattern\Zsf\Feature\Common\Bootstrap',
		),
	),
);