<?php
namespace ZendPattern\Zsf\Server;

use Zend\ServiceManager\ServiceManager;

class ZendServerManager extends ServiceManager
{
	const SERVICE_KEY = 'Zsf\ZendServerManager';
	const CONFIG_KEY = 'Zsf\ZendServerManager\Config';
	const SERVERS_CONFIG_KEY = 'Zsf\ZendServerManager\ZSConfig';
	
	/**
	 * Get all ZendServer names
	 * 
	 * Name = key 
	 * @return array:
	 */
	public function getZendServers()
	{
		$config = $this->get('config');
		$serverList = $config[self::SERVERS_CONFIG_KEY];
		foreach ($serverList as $key => $configServer){
			//@todo : could be grate if we have Zend Server proxy instead
			$zendServers[$key] = $this->get($key);
		}
		return $zendServers;	
	}
}