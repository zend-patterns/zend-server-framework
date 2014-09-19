<?php
namespace ZendPattern\Zsf\Server;

use ZendPattern\Zsf\Feature\FeatureSet;
use ZendPattern\Zsf\Api\Key\KeyManager;
use ZendPattern\Zsf\Server\WebInterface;
use Zend\ServiceManager\Config;
/**
 * Zend Server implementation
 * 
 * @author sophpie
 *
 */
class ZendServer extends ServerAbstract
{
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Server\ServerAbstract::checkEditionValidity()
	 */
	protected function checkEditionValidity()
	{
		return true;
	}
}