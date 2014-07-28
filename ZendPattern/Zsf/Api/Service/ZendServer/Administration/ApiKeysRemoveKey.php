<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer\Administration;

use ZendPattern\Zsf\Api\Service\ServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;

class ApiKeysRemoveKey extends ServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_POST;
		$this->requiredParams = array();
		$this->requiredPermission = self::PERMISSION_READ;
		$this->uriPath = 'apiKeysRemoveKey';
		$this->addParameter(new ApiParameter('ids', ApiParameter::TYPE_ARRAY,true));
	}
}