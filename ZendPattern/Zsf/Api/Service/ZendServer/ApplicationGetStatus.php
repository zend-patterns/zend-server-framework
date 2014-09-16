<?php
namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\Service\ApiServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;
/**
 * Get the list of applications currently deployed (or staged) on the server or the cluster and information about each application.
 * If application IDs are specified, this method will return information about the specified applications.
 * If no IDs are specified, this method will return information about all applications on the server or cluster.
 * 
 * Version : 1.2
 * Required Permissions: Read-pnly
 * HTTP method: GET
 * Supported by Editions:Zend Server
 * @author sophpie
 *
 */
class ApplicationGetStatus extends ApiServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_GET;
		$this->apiVersion = '1.2';
		$this->uriPath = 'applicationGetStatus';
		$this->addParameter(new ApiParameter('applications', ApiParameter::TYPE_ARRAY));
		$this->addParameter(new ApiParameter('direction', ApiParameter::TYPE_STRING));
	}
}