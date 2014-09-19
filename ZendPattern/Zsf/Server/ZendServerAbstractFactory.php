<?php
namespace ZendPattern\Zsf\Server;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZendPattern\Zsf\Feature\FeatureSet;

class ZendServerAbstractFactory implements AbstractFactoryInterface
{
    const ZEND_SERVERS_CONFIG_KEY = 'zend_servers';
    const ZEND_SERVER_CONFIGURATOR_KEY = 'Zsf\ZendServerConfigurator';
    
    /**
     * (non-PHPdoc)
     * @see \Zend\ServiceManager\AbstractFactoryInterface::canCreateServiceWithName()
     */
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        $config = $serviceLocator->get('config');
        if ( ! isset($config[self::ZEND_SERVERS_CONFIG_KEY])) return false;
        $serverConfig = $config[self::ZEND_SERVERS_CONFIG_KEY];
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
    	$serverConfig = $config[self::ZEND_SERVERS_CONFIG_KEY][$name];
    	$serverConfigurator = $serviceLocator->get(self::ZEND_SERVER_CONFIGURATOR_KEY);
    	$server = new ZendServer();
    	$serverConfigurator->configure($server,$serverConfig);
    	$server->setFeatureSet($serviceLocator->get(FeatureSet::FEATURE_SET_KEY));
    	return $server;
    }
}