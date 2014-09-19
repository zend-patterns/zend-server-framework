<?php
namespace ZendPattern\Zsf\Feature;

use ZendPattern\Zsf\Server\ServerInterface;
use ZendPattern\Zsf\Exception\Exception;
class FeatureSet__
{
	/**
	 * Features
	 * 
	 * @var array
	 */
	protected $features = array();
	
	/**
	 * Reference to server
	 * 
	 * @var ServerInterface
	 */
	protected $server;
	
	/**
	 * Adding feature
	 * 
	 * @param FeatureInterface $feature
	 */
	public function addFeature(FeatureInterface $feature)
	{
		if ($this->hasFeature($feature->getName())) return;
		foreach ($feature->getDependencies() as $depName){
			$dependency = new $depName();
			$this->checkFeatureCompatibiliy($dependency);
			$this->addFeature($dependency);
		}
		$this->checkFeatureCompatibiliy($feature);
		$feature->setServer($this->server);
		$this->features[$feature->getName()] = $feature;
	}
	
	/**
	 * Check if given feature is compatible with server
	 * 
	 * @return boolean
	 */
	protected function checkFeatureCompatibiliy(FeatureInterface $feature)
	{
		if (version_compare($this->server->getVersion(), $feature->getMinimalZSVersion(),'<')) {
			throw new Exception($feature->getName() . ' need Zend Server ' . $feature->getMinimalZSVersion() . ' at least. Zend Server version is ' . $this->server->getVersion());
		}
		return true;
	}
	
	/**
	 * Remove feature from set
	 * 
	 * @param string $name
	 */
	public function removeFeature($name)
	{
		$name = strtolower($name);
		unset($this->features[$name]);
	}
	
	/**
	 * Check either set has a feature or not
	 * 
	 * @param string $name
	 */
	public function hasFeature($name)
	{
		$name = strtolower($name);
		if (array_key_exists($name, $this->features)) return  true;
	}
	
	/**
	 * Get fetaure
	 * 
	 * @param string $name
	 */
	public function get($name)
	{
		$name = strtolower($name);
		if ( ! $this->hasFeature($name)) return;
		return $this->features[$name];
	}
	
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

}