<?php
namespace ZendPattern\Zsf\Api\Key;

use ZendPattern\Zsf\Exception\Exception;

class KeyManager
{
	/**
	 * Api keys
	 * 
	 * @var array
	 */
	protected $apiKeys = array();
	
	/**
	 * Name of an admin Api Key
	 * 
	 * @var string
	 */
	protected $adminApiKeyName = 'admin';
	
	/**
	 * Add an Api ey
	 * 
	 * @param ApiKey $apikey
	 * @param boolean $isAdmin
	 */
	public function addApiKey(Key $apikey,$isAdmin = false)
	{
		$keyName = $apikey->getName();
		$this->apiKeys[$keyName] = $apikey;
		if ($isAdmin || count($this->apiKeys) == 1) $this->adminApiKeyName = $keyName;
	}
	
	/**
	 * Remove an Api key
	 * 
	 * @param unknown $keyName
	 */
	public function removeApiKey($keyName)
	{
		unset($this->apiKeys[$keyName]);
	}
	
	/**
	 * Get Api key
	 * 
	 * @param string $keyName
	 * @throws Exception
	 * @return multitype:
	 */
	public function getApiKey($keyName = null)
	{
		if ( ! $keyName) {
			return $this->getAdminApiKey();
		}
		if ( ! isset($this->apiKeys[$keyName])) throw new Exception('Requested api key doesn\'t exists : ' . $keyName);
		return $this->apiKeys[$keyName];
	}
	
	/**
	 * Get admin api key
	 * 
	 * @return ApiKey
	 */
	public function getAdminApiKey()
	{
		return $this->getApiKey($this->adminApiKeyName);
	}
	
	/**
	 * Check key validity
	 * 
	 * @param string $keyName
	 * @param string $keyHash
	 */
	public function validateKey($keyName,$keyHash)
	{
		$key = $this->getApiKey($keyName);
		return ($keyHash == $key->getHash());
	}
	
	/**
	 * Key API Keys list
	 * 
	 * @return array
	 */
	public function getApiKeys()
	{
		return $this->apiKeys;
	}
}