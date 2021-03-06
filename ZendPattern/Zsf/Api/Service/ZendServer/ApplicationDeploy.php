<?php
namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\ApiParameter;
use ZendPattern\Zsf\Api\Service\ApiServiceAbstract;
/**
 * Deploy a new application to the server or cluster.
 * This process is asynchronous, meaning the initial request will wait
 * until the application is uploaded and verified, and  the initial
 * response will show information about the application being deployed.
 * However, the staging and activation process will proceed after the
 * response is returned. You must continue checking the application status
 * using the applicationGetStatus method until the deployment process is complete.
 * 
 * Version: 1.2
 * Required Permissions: Full
 * HTTP method: POST
 * Supported by Editions:Zend Server
 * @author sophpie
 *
 */
class ApplicationDeploy extends ApiServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_POST;
		$this->apiVersion = '1.2';
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