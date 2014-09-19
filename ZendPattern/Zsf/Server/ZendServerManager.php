<?php
namespace ZendPattern\Zsf\Server;

use Zend\ServiceManager\ServiceManager;

class ZendServerManager extends ServiceManager
{
	const SERVICE_KEY = 'Zsf\ZendServerManager';
	const CONFIG_KEY = 'Zsf\ZendServerManager\Config';
}