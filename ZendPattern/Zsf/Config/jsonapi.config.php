<?php
return array(
		'controllers' => array(
			'invokables' => array(
				'Zsf\JsonApi\Statistics' => 'ZendPattern\Zsf\JsonApi\Controller\StatisticsController'
			),
		),
		'router' => array (
				'routes' => array (
						'jsonApi' => array (
								'type' => 'Literal',
								'options' => array (
										'route' => '/jsonapi/',
										'defaults' => array (
												//'controller' => MessagingController::CONTROLLER_KEY,
												//'action' => 'get'
										)
								),
								'may_terminate' => true,
								'child_routes' => array (
										'default' => array (
												'type' => 'Segment',
												'options' => array (
														'route' => '/[:controller[/:action]]',
														'constraints' => array (
																'action' => '[a-zA-Z][a-zA-Z0-9_-]*'
														),
														'defaults' => array ()
												)
										)
								)
						)
				)
		),
);