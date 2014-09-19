<?php
return array(
		'extension' => array(
			'model'    => 'ZendPattern\Zsf\Configuration\Extension',
			'hydrator' => 'ZendPattern\Zsf\Api\XmlHydrator\ExtensionHydrator',
		),
		'extensions' => array(
			'model'    => 'ZendPattern\Zsf\Configuration\ExtensionCollection',
			'hydrator' => 'ZendPattern\Zsf\Api\XmlHydrator\ExtensionCollectionHydrator',
		),
);