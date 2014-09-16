<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\Service\ServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;
/**
 * Get all details available on a particular audit item.
 * 
 * Required Permissions: Read-only
 * HTTP method: GET
 * Supported by Editions: All
 * @author sophpie
 *
 */
class AuditGetDetails extends ServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_GET;
		$this->version = '1.3';
		$this->uriPath = 'auditGetDetails';
		$this->addParameter(new ApiParameter('auditId', ApiParameter::TYPE_INTEGER,true));
	}
}