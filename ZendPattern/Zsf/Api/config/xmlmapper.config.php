<?php
return array(
		'extension' => array(
			'model' => 'ZendPattern\Zsf\Configuration\PhpExtension\PhpExtension',
			'hydrator' => 'ZendPattern\Zsf\Configuration\PhpExtension\XmlHydrator\PhpExtensionXmlHydrator',
		),
		'extensions' => array(
			'model' => 'ZendPattern\Zsf\Configuration\PhpExtension\PhpExtensionCollection',
			'hydrator' => 'ZendPattern\Zsf\Configuration\PhpExtension\XmlHydrator\PhpExtensionCollectionXmlHydrator',
		),
);