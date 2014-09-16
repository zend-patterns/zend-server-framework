<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\Service\ApiServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;
/**
 * Rollback an existing application to its previous version. 
 * This process is asynchronous, meaning the initial request will start the rollback process and the initial response will show information about the application being rolled back.
 * You must continue checking the application status using the applicationGetStatus method until the process is complete.
 * 
 * Version: 1.2
 * Required Permissions: Full
 * HTTP method: POST
 * Supported by Editions: Zend Server
 * @author sophpie
 *
 */
class ApplicationRollback extends ApiServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_POST;
		$this->apiversion = '1.2';
		$this->uriPath = 'applicationRollback';
		$this->addParameter(new ApiParameter('appId', ApiParameter::TYPE_INTEGER,true));
	}
}