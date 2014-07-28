<?php
namespace ZendPattern\Zsf\Api\Service;

use ZendPattern\Zsf\Api\ApiParameter;
/**
 * Abstract class to describe a native zend Server API service
 * @author sophpie
 *
 */
abstract class ApiServiceAbstract
{
	const HTTP_METHOD_GET = 'GET';
	const HTTP_METHOD_POST = 'POST';
	
	const PERMISSION_READ = 'read';
	
	/**
	 * HTTP method GET | POST
	 *
	 * @var string
	 */
	protected $httpMethod;
	
	/**
	 * Uri path of service
	 * 
	 * @var string
	 */
	protected $uriPath;
	
	/**
	 * Parameter
	 * 
	 * @var array of ApiParameter
	 */
	protected $parameters = array();
	
	/**
	 * Minimal Zend Server Api Version
	 * 
	 * @var string
	 */
	protected $apiVersion;
	
	protected $requiredPermission;
	
	/**
	 * Authgorized Zend Server editions
	 * 
	 * @var array
	 */
	protected $serverEdition;
	
	/**
	 * Add parameter
	 *
	 * @param ApiParameter $apiParameter
	 */
	public function addParameter(ApiParameter $apiParameter)
	{
		$this->parameters[$apiParameter->getName()] = $apiParameter;
	}
	
	/**
	 * @return the $uriPath
	 */
	public function getUriPath() {
		return $this->uriPath;
	}
	
	/**
	 * @param string $uriPath
	 */
	public function setUriPath($uriPath) {
		$this->uriPath = $uriPath;
	}
	/**
	 * @return the $parameters
	 */
	public function getParameters() {
		return $this->parameters;
	}
	/**
	 * @return the $httpMethod
	 */
	public function getHttpMethod() {
		return $this->httpMethod;
	}

	/**
	 * @param string $httpMethod
	 */
	public function setHttpMethod($httpMethod) {
		$this->httpMethod = $httpMethod;
	}
	
	/**
	 * @return the $apiVersion
	 */
	public function getApiVersion() {
		return $this->apiVersion;
	}
}