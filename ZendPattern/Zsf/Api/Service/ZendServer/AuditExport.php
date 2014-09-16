<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\Service\ServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;
use ZendPattern\Zsf\Api\Response\ResponseFile;
/**
 * Export the audit log to zipped log file.
 * 
 * Version: 1.3
 * Required Permissions: Read-only
 * HTTP method: GET
 * Supported by Editions: All
 * @author sophpie
 *
 */
class AuditExport extends ServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_GET;
		$this->version = '1.3';
		$this->uriPath = 'auditExport';
		$this->addParameter(new ApiParameter('filters', ApiParameter::TYPE_ARRAY));
	}
}