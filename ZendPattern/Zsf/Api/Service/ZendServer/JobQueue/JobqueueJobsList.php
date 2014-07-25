<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer\JobQueue;

use ZendPattern\Zsf\Api\Service\ServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;

class JobqueueJobsList extends ServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_GET;
		$this->requiredParams = array();
		$this->requiredPermission = self::PERMISSION_READ;
		$this->uriPath = 'jobqueueJobsList';
		$this->addParameter(new ApiParameter('limit', ApiParameter::TYPE_INTEGER));
		$this->addParameter(new ApiParameter('offset', ApiParameter::TYPE_INTEGER));
		$this->addParameter(new ApiParameter('orderBy', ApiParameter::TYPE_STRING));
		$this->addParameter(new ApiParameter('direction', ApiParameter::TYPE_STRING));
		$this->addParameter(new ApiParameter('filter', ApiParameter::TYPE_ARRAY));
	}
}