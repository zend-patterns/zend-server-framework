<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer;
/**
 * Retrieve a list of extensions and associated information.
 * This list can be filtered by extension type (PHP Extension and Zend Extension).
 * This list of extensions contains only meta and operation information about the extension, and does not include directives and internal state.
 * 
 * Version: 1.3
 * Required Permissions: Read-only
 * HTTP method: GET
 * Supported by Editions: All
 */
use ZendPattern\Zsf\Api\ApiParameter;
use ZendPattern\Zsf\Api\Service\ApiServiceAbstract;

class ConfigurationExtensionsList extends ApiServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_GET;
		$this->uriPath = 'configurationExtensionsList';
		$this->apiVersion = '1.3';
		$this->addParameter(new ApiParameter('type', ApiParameter::TYPE_STRING));
		$this->addParameter(new ApiParameter('order', ApiParameter::TYPE_STRING));
		$this->addParameter(new ApiParameter('direction', ApiParameter::TYPE_STRING));
		$this->addParameter(new ApiParameter('filter', ApiParameter::TYPE_STRING));
	}
}