<?php
namespace ZendPattern\Zsf\Server;

use ZendPattern\Zsf\Server\WebInterface;
use ZendPattern\Zsf\Api\Key\KeyManager;
use ZendPattern\Zsf\Feature\FeatureInterface;

interface ServerInterface
{
	/**
	 * Return Zend Server version
	 * 
	 * @return string
	 */
	public function getVersion();
	
	/**
	 * Set Zend Server version
	 * 
	 * @param string $version
	 */
	public function setVersion($version);
	
	/**
	 * Retunr API Version
	 * 
	 * @return string
	 */
	public function getApiVersion();
	
	/**
	 * Return Zend Server Edition
	 * 
	 * @return string
	 */
	public function getEdition();
	
	/**
	 * Set Zend Server edition
	 * 
	 * @param string $edition
	 */
	public function setEdition($edition);
	
	/**
	 * Return the web interface
	 * 
	 * Web interface are URI informations
	 * @return WebInterface
	 */
	public function getWebInterface();
	
	/**
	 * Set web interface
	 * 
	 * @param WebInterface $webInterface
	 */
	public function setWebInterface(WebInterface $webInterface);
	
	/**
	 * Retunr keys manager
	 * 
	 * @return KeyManager
	 */
	public function getKeyManager();
	
	/**
	 * Set key manager
	 * 
	 * @param KeyManager $keyManager
	 * @param KeyManager $keyManager
	 */
	public function setKeyManager(KeyManager $keyManager);
	
	/**
	 * Add feature
	 * 
	 * @param FeatureInterface $feature
	 */
	public function addFeature(FeatureInterface $feature);
}