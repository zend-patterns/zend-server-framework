<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\Service\ApiServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;
/**
 * Deactivates an extension by unloading it.
 * This action requires a restart be performed on the server to apply the change.
 * 
 * Version: 1.3
 * Required Permissions: Full
 * HTTP method: POST
 * Supported by Editions: All
 */
class ConfigurationExtensionsOff extends ApiServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_POST;
		$this->apiVersion = '1.3';
		$this->uriPath = 'configurationExtensionsOff';
		$this->addParameter(new ApiParameter('extensions', ApiParameter::TYPE_ARRAY));
	}
}