<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer\Administration;

use ZendPattern\Zsf\Api\Service\ServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;

class ApiKeysAddKey extends ServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_POST;
		$this->requiredParams = array();
		$this->requiredPermission = self::PERMISSION_READ;
		$this->uriPath = 'apiKeysAddKey';
		$this->addParameter(new ApiParameter('name', ApiParameter::TYPE_STRING,true));
		$this->addParameter(new ApiParameter('username', ApiParameter::TYPE_STRING,true));
	}
}