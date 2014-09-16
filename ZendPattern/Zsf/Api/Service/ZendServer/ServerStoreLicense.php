<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\Service\ServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;
/**
 * Validate and store a Zend Server license key.
 * 
 * Version: 1.3
 * Required Permissions: Read-only
 * HTTP method: POST
 * Supported by Editions: All
 * @author sophpie
 *
 */
class ServerStoreLicense extends ServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_POST;
		$this->uriPath = 'serverStoreLicense';
		$this->version = '1.3';
		$this->addParameter(new ApiParameter('licenseName', ApiParameter::TYPE_STRING,true));
		$this->addParameter(new ApiParameter('licenseValue', ApiParameter::TYPE_STRING,true));
	}
}