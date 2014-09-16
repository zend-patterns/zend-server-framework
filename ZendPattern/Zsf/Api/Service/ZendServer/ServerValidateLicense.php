<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\Service\ApiServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;
/**
 * Validate a Zend Server license
 * 
 * Version: 1.3
 * Required Permissions: Read-only
 * HTTP method: POST
 * Supported by Editions: All
 * @author sophpie
 *
 */
class ServerValidateLicense extends ApiServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_POST;
		$this->uriPath = 'serverValidateLicense';
		$this->apiVersion = '1.3';
		$this->addParameter(new ApiParameter('licenseName', ApiParameter::TYPE_STRING,true));
		$this->addParameter(new ApiParameter('licenseValue', ApiParameter::TYPE_STRING,true));
	}
}