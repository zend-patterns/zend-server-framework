<?php
namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\ApiParameter;
use ZendPattern\Zsf\Api\Service\ApiServiceAbstract;
/**
 * This method allows you to update an existing application.
 * The package you provide must contain the same application.
 * Additionally, any new parameters or new values for existing parameters must be provided.
 * This process is asynchronous, meaning the initial request will wait until the package is uploaded and verified,
 * and the initial response will show information about the new version being deployed.
 * However, the staging and activation process will proceed after the response is returned.
 * You must continue checking the application status using the applicationGetStatus method until the deployment process is complete.
 * 
 * Version: 1.2
 * Required Permissions: Full
 * HTTP method: POST
 * Supported by Editions:Zend Server
 * @author sophpie
 *
 */
class ApplicationUpdate extends ApiServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_POST;
		$this->apiVersion = '1.2';
		$this->uriPath = 'applicationUpdate';
		$this->addParameter(new ApiParameter('appId',ApiParameter::TYPE_INTEGER,true));
		$this->addParameter(new ApiParameter('appPackage', ApiParameter::TYPE_FILE,true));
		$this->addParameter(new ApiParameter('ignoreFailure', ApiParameter::TYPE_BOOLEAN));
		$this->addParameter(new ApiParameter('userParams', ApiParameter::TYPE_ARRAY));
		
	}
}