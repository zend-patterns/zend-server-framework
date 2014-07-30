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
	 * Configuration Array
	 * 
	 * @var array
	 */
	protected $configuration = array();
	
	/**
	 * Constructor
	 * 
	 * @param array $configuration
	 */
	public function __construct($configuration)
	{
		$this->configuration = $configuration;
	}
	
	/**
	 * Configure server
	 * 
	 * @param ServerInterface $server
	 * @return ServerInterface
	 */
	public function configure(ServerInterface $server)
	{
		if (isset($this->configuration['version'])) $server->setVersion($this->configuration['version']);
		if (isset($this->configuration['edition'])) $server->setEdition($this->configuration['edition']);
		if (isset($this->configuration['uriPath'])) $server->getWebInterface()->setRootUri($this->configuration['uriPath']);
		if (isset($this->configuration['apiPath'])) $server->getWebInterface()->setApiPath($this->configuration['apiPath']);
		if (isset($this->configuration['apiKeys'])) {
			if (is_array($this->configuration['apiKeys'])) {
				$keyManager = new KeyManager();
				foreach ($this->configuration['apikeys'] as $name => $hash){
					if ($name == 'admin') $isAdmin = true;
					else $isAdmin = false;
					$keyManager->addApiKey(new Key($name, $hash),$isAdmin);
				}
				$server->setKeyManager($keyManager);
			}
		}
		if (isset($this->configuration['features'])) {
			if (is_array($this->configuration['features'])) {
				foreach ($this->configuration['features'] as $featureClass){
					$feature = new $featureClass();
					$server->addFeature($feature);
				}
			}
		}
		return $server;
	}
}