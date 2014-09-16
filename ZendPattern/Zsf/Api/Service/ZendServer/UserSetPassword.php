<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\Service\ApiServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;
/**
 * Modify a current user password.
 * 
 * Version: 1.3
 * Required Permissions: Full
 * HTTP method: POST
 * Supported by Editions: All
 * @author sophpie
 *
 */
class SetPassword extends ApiServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_POST;
		$this->uriPath = 'setPassword';
		$this->apiVersion = '1.3';
		$this->addParameter(new ApiParameter('password', ApiParameter::TYPE_STRING,true));
		$this->addParameter(new ApiParameter('newPassword', ApiParameter::TYPE_STRING,true));
		$this->addParameter(new ApiParameter('confirmNewPassword', ApiParameter::TYPE_STRING,true));
	}
}