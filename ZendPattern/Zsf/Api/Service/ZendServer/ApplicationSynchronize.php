<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\Service\ApiServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;
/**
 * Synchronizing an existing application, whether in order to fix a problem or to reset an installation.
 * This process is asynchronous, meaning the initial request will start the synchronize process and the initial response will show information about the application being synchronized.
 * However, the synchronize process will proceed after the response is returned.
 * You must continue checking the application status using the applicationGetStatus method until the process is complete.
 * 
 * Version: 1.2
 * Required Permissions: Full
 * HTTP method: POST
 * Supported by Editions: Zend Server
 * @author sophpie
 *
 */
class ApplicationSynchronize extends ApiServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_POST;
		$this->apiversion = '1.2';
		$this->uriPath = 'applicationSynchronize';
		$this->addParameter(new ApiParameter('appId', ApiParameter::TYPE_STRING,true));
		$this->addParameter(new ApiParameter('servers', ApiParameter::TYPE_ARRAY));
		$this->addParameter(new ApiParameter('ignoreFailure', ApiParameter::TYPE_BOOLEAN));
	}
}