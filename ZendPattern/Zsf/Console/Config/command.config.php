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
						'ZendPattern\Zsf\Console\Zpk' => 'ZendPattern\Zsf\Console\Controller\ZpkController',
						'ZendPattern\Zsf\Console\Zshell' => 'ZendPattern\Zsf\Console\Controller\ZshellController'
				) 
		),
		'console' => array (
				'router' => array (
						'routes' => array (
								'zshell' => array(
										'options' => array (
												'route' => 'zshell <name> [--url=] [--apiPath=]',
												'defaults' => array (
														'controller' => 'ZendPattern\Zsf\Console\Zshell',
														'action' => 'prompt' 
												) 
										) 
								),
								'zpk_init' => array(
										'options' => array (
												'route' => 'zpk init [--force] <name> <release> [--sourceDir=]',
												'defaults' => array (
														'controller' => 'ZendPattern\Zsf\Console\Zpk',
														'action' => 'init' 
												) 
										) 
								),
								'zpk_pack' => array(
										'options' => array (
												'route' => 'zpk pack [--sourceDir=] [--destinationDir=]',
												'defaults' => array (
														'controller' => 'ZendPattern\Zsf\Console\Zpk',
														'action' => 'pack'
												)
										)
								),
						) 
				) 
		) 
);