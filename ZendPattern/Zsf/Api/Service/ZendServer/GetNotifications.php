<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\Service\ApiServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;
/**
 * Retrieve a list of system messages, their details and meta information.
 * The list of messages includes state messages which cannot be modified and instance messages which can be changed.
 * The list is always ordered by level and date. Note that ÒRestartÓ level is the highest level and will appear first in any list.
 * 
 * Version: 1.3
 * Required Permissions: full
 * HTTP method: GET
 * Supported by Editions: All
 * Request Parameters: This method has no request parameters.
 * @author sophpie
 *
 */
class GetNotifications extends ApiServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_GET;
		$this->apiVersion = '1.3';
		$this->uriPath = 'getNotifications';
		$this->addParameter(new ApiParameter('hash', ApiParameter::TYPE_STRING));
	}
}