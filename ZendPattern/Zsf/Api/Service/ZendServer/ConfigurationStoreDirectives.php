<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer;
/**
 * Validate and store a list of directives and their corresponding values in the serverÕs configuration. Directives are validated according to their type and a predefined validation scheme.
 * 
 * Version: 1.3
 * Required Permissions: Full
 * HTTP method: POST
 * Supported by Editions: All
 */
use ZendPattern\Zsf\Api\ApiParameter;
use ZendPattern\Zsf\Api\Service\ApiServiceAbstract;

class ConfigurationStoreDirectives extends ApiServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_POST;
		$this->uriPath = 'configurationStoreDirectives';
		$this->apiVersion = '1.3';
		$this->addParameter(new ApiParameter('directives', ApiParameter::TYPE_ARRAY),true);
	}
}