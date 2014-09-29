<?php
use ZendPattern\Zsf\Server\ZendServerManager;
use ZendPattern\Zsf\Feature\FeatureSet;
use ZendPattern\Zsf\Server\Configurator;
use ZendPattern\Zsf\Api\XmlMapper;
use ZendPattern\Zsf\Message\Controller\MessagingController;
use ZendPattern\Zsf\Message\ZSMessageBroker;
use ZendPattern\Zsf\Message\Subscriber\SubscriberManager;

return array (
		'controllers' => array (
				'invokables' => array (
						MessagingController::CONTROLLER_KEY => 'ZendPattern\Zsf\Message\Controller\MessagingController', 
				) 
		),
		
		'router' => array (
				'routes' => array (
						'Messaging' => array (
								'type' => 'Literal',
								'options' => array (
										'route' => '/zsf',
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
		
		'service_manager' => array (
				'factories' => array (
						ZendServerManager::SERVICE_KEY => 'ZendPattern\Zsf\Server\ZendServerManagerFactory',
						XmlMapper::SERVICE_KEY => 'ZendPattern\Zsf\Api\XmlMapperFactory',
						ZSMessageBroker::SERVICE_KEY => 'ZendPattern\Zsf\Message\ZSMessageBrokerFactory',
						SubscriberManager::SERVICE_KEY => 'ZendPattern\Zsf\Message\Subscriber\SubscriberManagerFactory',
				),
				'abstractFactories' => array (
						'ZendPattern\Zsf\Api\Service\ApiServiceAbstractFactory' 
				) 
		),
		ZendServerManager::CONFIG_KEY => array (
				'invokables' => array (
						Configurator::SERVICE_KEY => 'ZendPattern\Zsf\Server\Configurator' 
				),
				'factories' => array (
						FeatureSet::SERVICE_KEY => 'ZendPattern\Zsf\Feature\FeatureSetFactory' 
				),
				'abstract_factories' => array (
						'ZendPattern\Zsf\Server\ZendServerAbstractFactory' 
				) 
		),
		
		XmlMapper::CONFIG_KEY => array (
				'services' => array (
						'collectionMarkups' => array (
								'notifications' => 'notification',
								'extensions' => 'extension',
								'jobs' => 'job',
								'components' => 'component',
								'directives' => 'directive',
								'rules' => 'rule'
						) 
				),
				'invokables' => array (
						'model::notification' => 'ZendPattern\Zsf\Model\Status\Notification',
						'hydrator::notification' => 'ZendPattern\Zsf\Api\XmlHydrator\NotificationHydrator',
						'model::extension' => 'ZendPattern\Zsf\Configuration\Model\Extension',
						'hydrator::extension' => 'ZendPattern\Zsf\Api\XmlHydrator\ExtensionHydrator',
						'model::job' => 'ZendPattern\Zsf\JobQueue\Model\Job',
						'hydrator::job' => 'ZendPattern\Zsf\Api\XmlHydrator\JobHydrator',
						'model::jobInfo' => 'ZendPattern\Zsf\JobQueue\Model\JobInfo',
						'hydrator::jobInfo' => 'ZendPattern\Zsf\Api\XmlHydrator\JobInfoHydrator',
						'model::rule' => 'ZendPattern\Zsf\JobQueue\Model\Rule',
						'hydrator::rule' => 'ZendPattern\Zsf\Api\XmlHydrator\RuleHydrator',
						'model::component' => 'ZendPattern\Zsf\Configuration\Model\Component',
						'hydrator::component' => 'ZendPattern\Zsf\Api\XmlHydrator\ComponentHydrator',
						'model::directive' => 'ZendPattern\Zsf\Configuration\Model\Directive',
						'hydrator::directive' => 'ZendPattern\Zsf\Api\XmlHydrator\DirectiveHydrator',
				),
				'abstract_factories' => array (
						'ZendPattern\Zsf\Api\XmlHydrator\CollectionHydratorAbstractFactory' 
				),
				'initializers' => array (
						'ZendPattern\Zsf\Api\XmlHydrator\XmlMapperInjector' 
				) 
		),
		 
);