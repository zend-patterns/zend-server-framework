<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\Service\ApiServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;
/**
 * Store a set of group mappings for resolving user roles during authentication.
 * These groups correspond to roles within the system or to applications that implicitly grant the developerLimited role to the user.
 * 
 * Version: 1.3
 * Required Permissions: Read-only
 * HTTP method: POST
 * Supported by Editions: All
 * @author sophpie
 *
 */
class UserSetAclGroups extends ApiServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_POST;
		$this->uriPath = 'userSetAclGroups';
		$this->apiVersion = '1.3';
		$this->addParameter(new ApiParameter('role_groups', ApiParameter::TYPE_ARRAY,true));
		$this->addParameter(new ApiParameter('app_groups', ApiParameter::TYPE_ARRAY));
	}
}