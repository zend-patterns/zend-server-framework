<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\Service\ApiServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;
/**
 * Job Queue API actions provide external actors with ways to query and manipulate jobs and their recurring definitions.
 *
 * Version: 1.3
 * Required Permissions: read-only
 * HTTP method: GET
 * Supported by Editions: Zend Server
 * @author sophpie
 */
class JobqueueJobsList extends ApiServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_GET;
		$this->apiVersion = '1.3';
		$this->uriPath = 'jobqueueJobsList';
		$this->addParameter(new ApiParameter('limit', ApiParameter::TYPE_INTEGER));
		$this->addParameter(new ApiParameter('offset', ApiParameter::TYPE_INTEGER));
		$this->addParameter(new ApiParameter('orderBy', ApiParameter::TYPE_STRING));
		$this->addParameter(new ApiParameter('direction', ApiParameter::TYPE_STRING));
		$this->addParameter(new ApiParameter('filter', ApiParameter::TYPE_ARRAY));
	}
}