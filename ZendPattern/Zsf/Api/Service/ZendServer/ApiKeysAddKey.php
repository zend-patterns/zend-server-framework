<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\Service\ServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;
/**
 * Add a WebAPI Key.

 * Version: 1.3
 * Required Permissions: Read-only
 * HTTP method: POST
 * Supported by Editions: All
 * @author sophpie
 *
 */
class ApiKeysAddKey extends ServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_POST;
		$this->uriPath = 'apiKeysAddKey';
		$this->version = '1.3';
		$this->addParameter(new ApiParameter('name', ApiParameter::TYPE_STRING,true));
		$this->addParameter(new ApiParameter('username', ApiParameter::TYPE_STRING,true));
	}
}