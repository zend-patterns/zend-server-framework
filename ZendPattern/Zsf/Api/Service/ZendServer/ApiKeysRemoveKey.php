<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\Service\ServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;
/**
 * Remove a WebAPI Key.
 * 
 * Version: 1.3
 * Required Permissions: Read-only
 * HTTP method: POST
 * Supported by Editions: All
 * @author sophpie
 *
 */
class ApiKeysRemoveKey extends ServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_POST;
		$this->uriPath = 'apiKeysRemoveKey';
		$this->version = '1.3';
		$this->addParameter(new ApiParameter('ids', ApiParameter::TYPE_ARRAY,true));
	}
}