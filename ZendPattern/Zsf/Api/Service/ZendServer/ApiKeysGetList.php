<?php
namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\Service\ApiServiceAbstract;
/**
 * Get list of all API keys
 * 
 * Version: 1.3
 * Required Permissions: Read-only
 * HTTP method: GET
 * Supported by Editions: All
 * @author sophpie
 *
 */
class ApiKeysGetList extends ApiServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_GET;
		$this->apiVersion = '1.3';
		$this->uriPath = 'apiKeysGetList';
	}
}