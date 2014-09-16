<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\Service\ApiServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;
/**
 * Define application to the server or cluster.
 * This process is asynchronous Ð the initial request will wait until the application is defined, and the initial response will show information about the application being defined Ð however the staging and activation process will proceed after the response is returned.
 * The user is expected to continue checking the application status using the applicationGetStatus method until the deployment process is complete.
 * 
 * Version: 1.3
 * Required Permissions: Full
 * HTTP method: POST
 * Supported by Editions: All
 * @author sophpie
 *
 */
class ApplicationDefine extends ApiServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_POST;
		$this->apiversion = '1.3';
		$this->uriPath = 'applicationDefine';
		$this->addParameter(new ApiParameter('name', ApiParameter::TYPE_FILE,true));
		$this->addParameter(new ApiParameter('baseUrl', ApiParameter::TYPE_STRING,true));
		$this->addParameter(new ApiParameter('version', ApiParameter::TYPE_STRING));
		$this->addParameter(new ApiParameter('healthCheck', ApiParameter::TYPE_STRING));
		$this->addParameter(new ApiParameter('logo', ApiParameter::TYPE_FILE));
	}
}