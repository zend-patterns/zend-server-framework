<?php
namespace ZendPattern\Zsf\Message;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZendPattern\Zsf\Server\ZendServerManager;

class ZSMessageBrokerFactory implements FactoryInterface
{
	const BROKER_NAME_KEY = 'brokerServerName';
	const APPLICATION_URL_KEY = 'applicationUrlKey';
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\FactoryInterface::createService()
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$zsMessageBrocker = new ZSMessageBroker();
		$config = $serviceLocator->get('config');
		$zsMessageBrokerConfig = $config[ZSMessageBroker::CONFIG_KEY];
		$zserver = $serviceLocator->get(ZendServerManager::SERVICE_KEY)->get($zsMessageBrokerConfig[self::BROKER_NAME_KEY]);
		$zsMessageBrocker->setZendServer($zserver);
		$zsMessageBrocker->setRootUrl($zsMessageBrokerConfig[self::APPLICATION_URL_KEY]);
		return $zsMessageBrocker;
	}
}