<?php
namespace ZendPattern\Zsf\Message\Subscriber;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\Config;

class SubscriberManagerFactory implements FactoryInterface
{
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\FactoryInterface::createService()
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$config = $serviceLocator->get('config');
		$SubscManagerConfig = $config[SubscriberManager::CONFIG_KEY];
		$subscrbiberManager = new SubscriberManager(new Config($SubscManagerConfig));
		return $subscrbiberManager;
	}
}