<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\Service\ApiServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;
/**
 * Clear data cache stored data
 * 
 * Version: 1.7
 * Required Permissions: Full
 * HTTP method: POST
 * Supported by Editions: All
 * @author sophpie
 *
 */
class DatacacheClear extends ApiServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_POST;
		$this->uriPath = 'datacacheClear';
		$this->apiVersion = '1.7';
		$this->addParameter(new ApiParameter('keys', ApiParameter::TYPE_ARRAY,true));
	}
}