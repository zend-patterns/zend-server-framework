<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\Service\ApiServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;
/**
 * Create a new job.
 *
 * Version: 1.6
 * Required Permissions: full
 * HTTP method: POST
 * Supported by Editions: Zend Server
 * @author sophpie
 */
class JobqueueAddJob extends ApiServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_POST;
		$this->apiVersion = '1.6';
		$this->uriPath = 'jobqueueAddJob';
		$this->addParameter(new ApiParameter('url', ApiParameter::TYPE_STRING,true));
		$this->addParameter(new ApiParameter('vars', ApiParameter::TYPE_ARRAY));
		$this->addParameter(new ApiParameter('options', ApiParameter::TYPE_ARRAY));
	}
}