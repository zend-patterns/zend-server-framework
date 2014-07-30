<?php
namespace ZendPattern\Zsf\Server;

use ZendPattern\Zsf\Feature\FeatureSet;
use ZendPattern\Zsf\Api\Key\KeyManager;
use ZendPattern\Zsf\Server\WebInterface;
/**
 * Zend Server implementation
 * 
 * @author sophpie
 *
 */
class ZendServer extends ServerAbstract
{
	/**
	 * Constructor
	 * 
	 */
	public function __construct()
	{
		$this->setKeyManager(new KeyManager());
		$this->setFeatureSet(new FeatureSet());
		$this->setWebInterface(new WebInterface());
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Server\ServerAbstract::checkEditionValidity()
	 */
	protected function checkEditionValidity()
	{
		return true;
	}
}