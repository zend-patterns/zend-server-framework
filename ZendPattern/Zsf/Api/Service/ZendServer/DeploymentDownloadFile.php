<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\Service\ApiServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;
/**
 * Download a deployment package file from a given URL to allow passing it to the deployment mechanism later.
 * 
 * Version: 1.6
 * Required Permissions: Full
 * HTTP method: POST
 * Supported by Editions: Zend Server
 * @author sophpie
 *
 */
class DeploymentDownloadFile extends ApiServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_POST;
		$this->apiversion = '1.6';
		$this->uriPath = 'deploymentDownloadFile';
		$this->addParameter(new ApiParameter('url', ApiParameter::TYPE_STRING,true));
		$this->addParameter(new ApiParameter('name', ApiParameter::TYPE_STRING,true));
		$this->addParameter(new ApiParameter('version', ApiParameter::TYPE_STRING,true));
		$this->addParameter(new ApiParameter('override', ApiParameter::TYPE_BOOLEAN));
	}
}