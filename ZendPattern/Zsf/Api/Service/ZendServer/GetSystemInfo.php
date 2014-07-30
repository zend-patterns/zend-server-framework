<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\Service\ApiServiceAbstract;
/**
 * Use this method to get information about the system,
 * including the Zend Server edition and version, PHP version,
 * licensing information, etc. This method produces similar output
 * on all Zend Server systems, and is future compatible.
 * 
 * Version: 1.0
 * Required Permissions: read
 * HTTP method: GET
 * Supported by Editions: All
 * Request Parameters: This method has no request parameters.
 * @author sophpie
 *
 */
class GetSystemInfo extends ApiServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_GET;
		$this->apiVersion = '1.0';
		$this->uriPath = 'getSystemInfo';
	}
}