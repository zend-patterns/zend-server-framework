<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\Service\ServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;
use ZendPattern\Zsf\Api\Response\ResponseFile;
/**
 * Save settings of audit history and triggers.
 * 
 * Version: 1.3
 * Required Permissions: Read-only
 * HTTP method: GET
 * Supported by Editions: All
 * @author sophpie
 *
 */
class AuditSetSettings extends ServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_GET;
		$this->version = '1.3';
		$this->uriPath = 'auditSetSettings';
		$this->addParameter(new ApiParameter('email', ApiParameter::TYPE_STRING));
		$this->addParameter(new ApiParameter('callbackUrl', ApiParameter::TYPE_STRING));
		$this->addParameter(new ApiParameter('history', ApiParameter::TYPE_INTEGER));
	}
}