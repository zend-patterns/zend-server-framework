<?php
namespace ZendPattern\Zsf\Server;

use ZendPattern\Zsf\Feature\FeatureSet;
use ZendPattern\Zsf\Feature\FeatureInterface;
use ZendPattern\Zsf\Api\Key\KeyManager;
use Zend\Permissions\Acl\Role\RoleInterface;
use ZendPattern\Zsf\Exception\Exception;
/**
 * Abstract class for Al zend Server instance
 * @author sophpie
 *
 */
abstract class ServerAbstract implements ServerInterface, RoleInterface
{
	/**
	 * Web interface
	 * 
	 * @var WebInterface
	 */
	protected $webInterface;
	
	/**
	 * Zend Server version
	 * 
	 * @var string
	 */
	protected $version;
	
	/**
	 * Api version supported by server
	 * 
	 * @var string
	 */
	protected $apiVersion;
	
	/**
	 * Zend Server edition
	 * 
	 * @var string
	 */
	protected $edition;
	
	/**
	 * Zend Server Feature Set
	 * 
	 * @var FeatureSet
	 */
	protected $featureSet;
	
	/**
	 * Api Keys manager
	 * 
	 * @var KeyManager
	 */
	protected $keyManager;
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Server\ServerInterface::getVersion()
	 */
	public function getVersion()
	{
		return $this->version;
	}

	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Server\ServerInterface::setVersion()
	 */
	public function setVersion($version) {
		$this->version = $version;
		$this->apiVersion = null;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Server\ServerInterface::getApiVersion()
	 */
	public function getApiVersion()
	{
		if ($this->apiVersion) return $this->apiVersion;
		$config = include __DIR__ . '/../Config/api.versions.config.php';
		$version = $this->version;
		if ( ! isset($config[$version])) throw new Exception('no API define for Zend Server ' .$version);
		$this->apiVersion = $config[$version];
		return $this->apiVersion;
	}
	
	/**
	 * @return the $edition
	 */
	public function getEdition() {
		return $this->edition;
	}
	
	/**
	 * @return the $featureSet
	 */
	public function getFeatureSet() {
		return $this->featureSet;
	}

	/**
	 * @param \ZendPattern\ZSWebAPI2\Feature\FeatureSet $featureSet
	 */
	public function setFeatureSet($featureSet) {
		$this->featureSet = $featureSet;
	}
	
	/**
	 * Adding feature
	 * 
	 * @param FeatureInterface $feature
	 */
	public function addFeature(FeatureInterface $feature)
	{
		$feature->setServer($this);
		$this->getFeatureSet()->addFeature($feature);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Server\ServerInterface::getWebInterface()
	 */
	public function getWebInterface() {
		return $this->webInterface;
	}

	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Server\ServerInterface::setWebInterface()
	 */
	public function setWebInterface(WebInterface $webInterface) {
		$this->webInterface = $webInterface;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Server\ServerInterface::setEdition()
	 */
	public function setEdition($edition) {
		$this->edition = $edition;
	}
	
	/**
	 * Calling features
	 * 
	 * @param string $method
	 * @param array $args
	 */
	public function __call($method,$args)
	{
		if ($this->featureSet->hasFeature($method)) {
			$feature = $this->featureSet->get($method);
			$feature->setServer($this);
			return $feature($args);
		}
		else throw new Exception('Feature or method : ' .$method . ' is not defined');
	}
	
	/**
	 * Calling features statically
	 * 
	 * @param string $method
	 * @param array $args
	 * @throws Exception
	 */
	static public function __callstatic($method,$args)
	{
		if ($this->featureSet->hasFeature($method)) {
			$feature = $this->featureSet->get($method);
			$feature->setServer($this);
			return $feature($args);
		}
		else throw new Exception('Feature or method : ' .$method . ' is not defined');
	}
	
	/**
	 * Check if edition is compatible with version
	 */
	abstract protected function checkEditionValidity();
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Server\ServerInterface::getKeyManager()
	 */
	public function getKeyManager() {
		return $this->keyManager;
	}

	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Server\ServerInterface::setKeyManager()
	 */
	public function setKeyManager(KeyManager $keyManager) {
		$this->keyManager = $keyManager;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Permissions\Acl\Role\RoleInterface::getRoleId()
	 */
	public function getRoleId()
	{
		$roleId = 'ZendServer-' . $this->getVersion() . '-' .$this->getEdition();
		return $roleId;
	}

}