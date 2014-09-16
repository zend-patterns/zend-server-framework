<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\Service\ApiServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;
/**
 * Modify current authentication settings, allowing the user to switch between simple and extended authentication and authorization schemes.
 * 
 * Version: 1.3
 * Required Permissions: Full
 * HTTP method: POST
 * Supported by Editions: All
 * @author sophpie
 *
 */
class UserAuthenticationSettings extends ApiServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_POST;
		$this->uriPath = 'userAuthenticationSettings';
		$this->apiVersion = '1.3';
		$this->addParameter(new ApiParameter('type', ApiParameter::TYPE_ENUM,true));
		$this->addParameter(new ApiParameter('ldap', ApiParameter::TYPE_ARRAY,true));
		$this->addParameter(new ApiParameter('password', ApiParameter::TYPE_STRING,true));
		$this->addParameter(new ApiParameter('confirmNewPassword', ApiParameter::TYPE_STRING,true));
	}
}