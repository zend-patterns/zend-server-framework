<?php
namespace ZendPattern\Zsf\Server;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\Config;

class ZendServerManagerFactory implements FactoryInterface
{
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\FactoryInterface::createService()
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$config = $serviceLocator->get('config');
		$ZSmanagerConfig = $config[ZendServerManager::CONFIG_KEY];
		$zendServerManager = new ZendServerManager(new Config($ZSmanagerConfig));
		$zendServerManager->setService('config', $config);
		return $zendServerManager;
	}
}