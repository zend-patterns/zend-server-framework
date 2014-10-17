<?php
namespace ZendPattern\Zsf;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
class Module implements ConfigProviderInterface
{
    /**
     * (non-PHPdoc)
     * @see \Zend\ModuleManager\Feature\ConfigProviderInterface::getConfig()
     */
    public function getConfig()
    {
    	$featuresConfigArray = include __DIR__ . '/Config/features.config.php';
    	$apiConfigArray = include __DIR__ . '/Config/api.versions.config.php';
    	$zsfConfigArray = include __DIR__ . '/Config/zsf.config.php';
    	$consoleConfiArray = include __DIR__ . '/Console/Config/command.config.php';
    	$jsonapiConfigArray = include __DIR__ . '/Console/Config/jsonapi.config.php';
    	$config = array_merge($featuresConfigArray,$apiConfigArray, $zsfConfigArray,$consoleConfiArray,$jsonapiConfigArray);
    	return $config;
    }
}