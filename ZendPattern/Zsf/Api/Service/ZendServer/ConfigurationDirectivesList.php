<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\Service\ApiServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;
/**
 * Retrieve a filtered list of directives and associated information.
 * This list can be filtered by extension name, however if an invalid or non-existing extension is passed, an valid empty result will be returned.
 * 
 * Version: 1.3
 * Required Permissions: Read-only
 * HTTP method: Get
 * Supported by Editions: All
 *
 */
class ConfigurationDirectivesList extends ApiServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_GET;
		$this->apiVersion = '1.3';
		$this->uriPath = 'configurationDirectivesList';
		$this->addParameter(new ApiParameter('extension', ApiParameter::TYPE_STRING));
		$this->addParameter(new ApiParameter('daemon', ApiParameter::TYPE_STRING));
		$this->addParameter(new ApiParameter('filter', ApiParameter::TYPE_STRING));
	}
}