<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\Service\ApiServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;
/**
 * This method allows you to remove an existing application.
 * This process is asynchronous, meaning the initial request will start the removal process and the initial response will show information about the application being removed.
 * However, the removal process will proceed after the response is returned.
 * You must continue checking the application status using the applicationGetStatus method until the removal process is complete.
 * Once applicationGetStatus contains no information about the application, it has been completely removed.
 * 
 * Version: 1.2
 * Required Permissions: Full
 * HTTP method: POST
 * Supported by Editions: Zend Server
 * @author sophpie
 *
 */
class ApplicationRemove extends ApiServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_POST;
		$this->apiversion = '1.2';
		$this->uriPath = 'applicationRemove';
		$this->addParameter(new ApiParameter('appId', ApiParameter::TYPE_INTEGER,true));
	}
}