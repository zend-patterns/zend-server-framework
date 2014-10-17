<?php
namespace ZendPattern\Zsf\Feature\Common;

use ZendPattern\Zsf\Feature\FeatureAbstract;
use ZendPattern\Zsf\Api\Key\KeyManager;
use ZendPattern\Zsf\Api\Key\Key;
/**
 * This feature allow server to discover and set its own API keys.
 * @param string $adminApiKeyHash : hash value for the Admin key
 * $server->autoDiscoverApiKeys($adminApiKeyHash)
 * @author sophpie
 *
 */
class AutoDiscoverApiKeys extends FeatureAbstract
{
	/**
	 *  Constructor
	 */
	public function __construct()
	{
		$this->setMinimalZSVersion('6.0.0');
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Feature\FeatureAbstract::__invoke()
	 */
	public function __invoke($args)
	{
		$keyManager = new KeyManager();
		$apiKeyList = $this->server->apiCall('apiKeysGetList')->getXmlContent();
		foreach ($apiKeyList->responseData->apiKeys->apiKey as $apiKey){
			$id = (string) $apiKey->id;
			$name = (string) $apiKey->name;
			$hash = (string) $apiKey->hash;
			$username = (string) $apiKey->username;
			$creationTime = (string) $apiKey->creationtime;
			$key = new Key($name, $hash,$username,$id,$creationTime);
			$keyManager->addApiKey($key,($name == 'admin'));
		}
		$this->server->setKeyManager($keyManager);
	}
}