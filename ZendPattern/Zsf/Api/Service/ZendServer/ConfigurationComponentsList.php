<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\Service\ApiServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;
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
class ConfigurationComponentsList extends ApiServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_GET;
		$this->apiVersion = self::PERMISSION_READ;
		$this->uriPath = 'configurationComponentsList';
		$this->addParameter(new ApiParameter('filter', ApiParameter::TYPE_STRING));
	}
}