<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer\Deployment;

use ZendPattern\Zsf\Api\Service\ServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;

class ApplicationDeploy extends ServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_POST;
		$this->requiredParams = array();
		$this->requiredPermission = self::PERMISSION_READ;
		$this->uriPath = 'applicationDeploy';
		$this->addParameter(new ApiParameter('appPackage', ApiParameter::TYPE_FILE,true));
		$this->addParameter(new ApiParameter('baseUrl', ApiParameter::TYPE_STRING,true));
		$this->addParameter(new ApiParameter('createVhost', ApiParameter::TYPE_BOOLEAN));
		$this->addParameter(new ApiParameter('defaultServer', ApiParameter::TYPE_BOOLEAN));
		$this->addParameter(new ApiParameter('userAppName', ApiParameter::TYPE_STRING));
		$this->addParameter(new ApiParameter('ignoreFailure', ApiParameter::TYPE_BOOLEAN));
		$this->addParameter(new ApiParameter('userParams', ApiParameter::TYPE_ARRAY));
		
	}
}