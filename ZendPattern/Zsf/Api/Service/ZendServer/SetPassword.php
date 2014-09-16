<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\Service\ApiServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;
/**
 * Modify a specific user password.
 * This action changes any user password and is an administrative action.
 * Note that a separate action exists for the user to modify his own password and has a lower permission level.
 * 
 * Version: 1.3
 * Required Permissions: Full
 * HTTP method: POST
 * Supported by Editions: All
 * @author sophpie
 *
 */
class UserSetPassword extends ApiServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_POST;
		$this->uriPath = 'userSetPassword';
		$this->apiVersion = '1.3';
		$this->addParameter(new ApiParameter('username', ApiParameter::TYPE_STRING,true));
		$this->addParameter(new ApiParameter('password', ApiParameter::TYPE_STRING,true));
		$this->addParameter(new ApiParameter('newPassword', ApiParameter::TYPE_STRING,true));
		$this->addParameter(new ApiParameter('confirmNewPassword', ApiParameter::TYPE_STRING,true));
	}
}