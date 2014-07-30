<?php
namespace ZendPattern\Zsf\Feature\ZendServer6;

use ZendPattern\Zsf\Feature\FeatureAbstract;
use ZendPattern\Zsf\Api\Key\Key;
use ZendPattern\Zsf\Exception\Exception;

class AutoDiscover extends FeatureAbstract
{
	/**
	 *  Constructor
	 */
	public function __construct()
	{
		$this->setDependencies(array(
				'ZendPattern\Zsf\Feature\ZendServer6\AutoDiscoverApiKeys'
		));
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Feature\FeatureAbstract::__invoke()
	 */
	public function __invoke($args)
	{
		$apiKey = $this->findApiKey($args);
		$this->server->getKeyManager()->addApiKey($apiKey);
		$info = $this->server->apiCall('getSystemInfo');
		$systemInfo = $info->getXmlContent()->responseData->systemInfo;
		$edition = (string) $systemInfo->edition;
		$version = (string) $systemInfo->zendServerVersion;
		$this->server->setVersion($version);
		$this->server->setEdition($edition);
		$this->server->autoDiscoverApiKeys();
	}
	
	/**
	 * Try to find a available API key
	 * 
	 * @param array $args
	 */
	protected function findApiKey($args)
	{
		$strategyNames = array('ByParameters','InServer');
		foreach ($strategyNames as $strategy) {
			$methodName = 'findApiKey' . $strategy;
			$strategyResult = $this->$methodName($args);
			if ( ! $strategyResult) continue;
			return $strategyResult;
		}
		throw new Exception('Cannot find API key to use');
	}
	
	/**
	 * Try to define a API key from parameters passed to feature
	 * 
	 * @param array $args
	 * @return boolean|\ZendPattern\Zsf\Api\Key\Key
	 */
	protected function findApiKeyByParameters($args)
	{
		if (count($args) == 0) return false;
		if (count($args) == 1) $apiKey = new Key('admin', $args[0]);
		elseif (count($args) == 2) $apiKey = new Key($args[0], $args[1]);
		else return false;
		return $apiKey;
	}
	
	/**
	 * Try to find an API key within server configuration
	 * 
	 * @param array $args
	 * @return boolean|\ZendPattern\Zsf\Api\Key\Key
	 */
	protected function findApiKeyInServer($args)
	{
		$apiKey = $this->server->getKeyManager()->getAdminApiKey();
		if ( ! $apiKey){
			$apiKeyList = $this->server->getKeyManager()->getApiKeys();
			$apiKey = current($apiKeyList);
		}
		if ( ! $apiKey) return false;
		return $apiKey;
	}
}
