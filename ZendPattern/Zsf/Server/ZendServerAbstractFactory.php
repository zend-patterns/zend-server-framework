<?php
namespace ZendPattern\Zsf\Server;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZendPattern\Zsf\Feature\FeatureSet;
use ZendPattern\Zsf\Server\ZendServerManager;

class ZendServerAbstractFactory implements AbstractFactoryInterface
{
    /**
     * (non-PHPdoc)
     * @see \Zend\ServiceManager\AbstractFactoryInterface::canCreateServiceWithName()
     */
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        $config = $serviceLocator->get('config');
        if ( ! isset($config[ZendServerManager::SERVERS_CONFIG_KEY])) return false;
        $serverConfig = $config[ZendServerManager::SERVERS_CONFIG_KEY];
        if (count($serverConfig) ==0 ) return false;
        if ( ! isset($serverConfig[$name])) return false;
        return true;
    }
    
    /**
     * (non-PHPdoc)
     * @see \Zend\ServiceManager\AbstractFactoryInterface::createServiceWithName()
     */
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
    	$config = $serviceLocator->get('config');
    	$serverConfig = $config[ZendServerManager::SERVERS_CONFIG_KEY][$name];
    	$serverConfigurator = $serviceLocator->get(Configurator::SERVICE_KEY);
    	$server = new ZendServer();
    	$serverConfigurator->configure($server,$serverConfig);
    	$server->setFeatureSet($serviceLocator->get(FeatureSet::SERVICE_KEY));
    	return $server;
    }
}