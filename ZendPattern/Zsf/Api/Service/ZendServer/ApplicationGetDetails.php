<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\Service\ApiServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;
/**
 * Retrieve package and meta information about a deployed application.
 * This action provides the most complete list
 * of information about a single application we can provide.
 * 
 * Version: 1.3
 * Required Permissions: Read-only
 * HTTP method: GET
 * Supported by Editions: Zend Server
 * @author sophpie
 *
 */
class ApplicationGetDetails extends ApiServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_GET;
		$this->apiversion = '1.3';
		$this->uriPath = 'applicationgetDetails';
		$this->addParameter(new ApiParameter('application', ApiParameter::TYPE_INTEGER,true));
	}
}