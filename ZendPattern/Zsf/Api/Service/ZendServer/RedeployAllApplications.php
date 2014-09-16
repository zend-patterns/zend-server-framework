<?php
namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\Service\ApiServiceAbstract;
/**
 * Redeploy all applications currently registered in the system for the specified servers.
 * This action only sends the operation request and will not wait on completion.
 * 
 * Version: 1.3
 * Required Permissions: Read-only
 * HTTP method: POST
 * Supported by Editions: Zend Server
 * @author sophpie
 *
 */
class RedeployAllApplications extends ApiServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_GET;
		$this->apiVersion = '1.3';
		$this->uriPath = 'redeployAllApplications';
		$this->addParameter(new ApiParameter('servers', ApiParameter::TYPE_ARRAY));
	}
}