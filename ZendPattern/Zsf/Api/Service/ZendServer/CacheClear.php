<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\Service\ServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;
/**
 * Clear cache data of a specified component.
 * 
 * Version: 1.3
 * Required Permissions: Read-only
 * HTTP method: POST
 * Supported by Editions: All
 * @author sophpie
 *
 */
class CacheClear extends ServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_POST;
		$this->uriPath = 'cacheClear';
		$this->version = '1.3';
		$this->addParameter(new ApiParameter('component', ApiParameter::TYPE_STRING,true));
	}
}