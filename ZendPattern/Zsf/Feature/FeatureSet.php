<?php
namespace ZendPattern\Zsf\Feature;

use Zend\ServiceManager\ServiceManager;
use ZendPattern\Zsf\Server\ZendServer;

class FeatureSet extends ServiceManager
{
    /**
     * Service manager config key for feature set
     */
    const FEATURE_SET_GONFIG_KEY = 'Zsf\featureSet\Config';
    const FEATURE_SET_KEY = 'Zsf\featureSet';
    
	/**
	 * ZendServer
	 * @var ZendServer
	 */
	protected $server;
	
	/**
	 * @return the $server
	 */
	public function getServer() {
		return $this->server;
	}
	
	/**
	 * @param \ZendPattern\Zsf\Server\ServerInterface $server
	 */
	public function setServer($server) {
		$this->server = $server;
	}
	
	/**
	 * Check if feature has been
	 * @param unknown $featureName
	 * @return boolean
	 */
	public function hasFeature($featureName)
	{
		return $this->has($featureName);
	}
}