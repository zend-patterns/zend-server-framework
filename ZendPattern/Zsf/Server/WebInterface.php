<?php
namespace ZendPattern\Zsf\Server;

use Zend\Uri\Http;
/**
 * Modelize the HTTP parameters of a Zend Server implementation
 * @author sophpie
 *
 */
class WebInterface
{
	const DEFAULT_HOST = 'http://localhost:10081';
	const DEFAULT_API_PATH = 'ZendServer/Api';
	/**
	 * Zend Server root Uri
	 * 
	 * @var Uri
	 */
	protected $rootUri;
	
	/**
	 * Web API path
	 * 
	 * @var string
	 */
	protected $apiPath;
	
	/**
	 * Constructor
	 * 
	 * @param string $rootUri :
	 * @param unknown $apiPath
	 */
	public function __construct($rootUri = self::DEFAULT_HOST,$apiPath = self::DEFAULT_API_PATH)
	{
		$rootUri = new Http($rootUri);
		$this->setRootUri($rootUri);
		$this->setApiPath($apiPath);
	}
	
	/**
	 * @param string $apiPath
	 */
	public function setApiPath($apiPath) {
		$this->apiPath = trim($apiPath,'/');
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Server\ServerInterface::getApiUri()
	 */
	public function getApiUri()
	{
		$uri = clone $this->rootUri;
		$rootPath = rtrim($this->rootUri->getPath(), '/');
		$uri->setPath($rootPath . '/' . $this->apiPath);
		return $uri;
	}
	
	/**
	 * @return the $rootUri
	 */
	public function getRootUri() {
		return $this->rootUri;
	}
	
	/**
	 * @param \Zend\Uri\Uri $rootUri
	 */
	public function setRootUri($rootUri) {
		$this->rootUri = $rootUri;
	}
}