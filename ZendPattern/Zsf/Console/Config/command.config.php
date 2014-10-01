<?php
use ZendPattern\Zsf\Package\ManifestXmlManager;
return array (
		'service_manager' => array(
				'invokables' => array(
					ManifestXmlManager::SERVICE_KEY => 'ZendPattern\Zsf\Package\ManifestXmlManager',
				),
		),
		'controllers' => array (
				'invokables' => array (
						'ZendPattern\Zsf\Console\Zpk' => 'ZendPattern\Zsf\Console\Controller\ZpkController' 
				) 
		),
		'console' => array (
				'router' => array (
						'routes' => array (
								'zpk_pack' => array (
										'options' => array (
												'route' => 'zpk pack [--sourceDir=]',
												'defaults' => array (
														'controller' => 'ZendPattern\Zsf\Console\Zpk',
														'action' => 'pack' 
												) 
										) 
								),
								'zpk_init' => array(
										'options' => array (
												'route' => 'zpk init <name> [--sourceDir=]',
												'defaults' => array (
														'controller' => 'ZendPattern\Zsf\Console\Zpk',
														'action' => 'init' 
												) 
										) 
								),
						) 
				) 
		) 
);