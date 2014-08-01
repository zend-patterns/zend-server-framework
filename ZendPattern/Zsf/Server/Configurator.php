<?php
namespace ZendPattern\Zsf\Server;

use ZendPattern\Zsf\Server\ServerInterface;
use ZendPattern\Zsf\Api\Key\KeyManager;
use ZendPattern\Zsf\Api\Key\Key;
/**
 * Configurator for Server instance
 * @author sophpie
 *
 */
class Configurator
{
	/**
	 * Configure server
	 * 
	 * @param ServerInterface $server
	 * @return ServerInterface
	 */
	public function configure(ServerInterface $server, array $configuration)
	{
		if (isset($configuration['version'])) $server->setVersion($configuration['version']);
		if (isset($configuration['edition'])) $server->setEdition($configuration['edition']);
		if (isset($configuration['uriPath'])) $server->getWebInterface()->setRootUri($configuration['uriPath']);
		if (isset($configuration['apiPath'])) $server->getWebInterface()->setApiPath($configuration['apiPath']);
		if (isset($configuration['apiKeys'])) {
			if (is_array($configuration['apiKeys'])) {
				$keyManager = new KeyManager();
				foreach ($configuration['apikeys'] as $name => $hash){
					if ($name == 'admin') $isAdmin = true;
					else $isAdmin = false;
					$keyManager->addApiKey(new Key($name, $hash),$isAdmin);
				}
				$server->setKeyManager($keyManager);
			}
		}
		if (isset($configuration['features'])) {
			if (is_array($configuration['features'])) {
				foreach ($configuration['features'] as $featureClass){
					$feature = new $featureClass();
					$server->addFeature($feature);
				}
			}
		}
		return $server;
	}
	
	/**
	 * Check if given configuration is ok
	 * 
	 * @param array $configuration
	 */
	protected function checkConfiguration(array $configuration)
	{
	}
}