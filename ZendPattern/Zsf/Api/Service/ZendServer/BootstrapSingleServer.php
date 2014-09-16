<?php

namespace ZendPattern\Zsf\Api\Service\ZendServer;

use ZendPattern\Zsf\Api\Service\ServiceAbstract;
use ZendPattern\Zsf\Api\ApiParameter;
/**
 * Bootstrap a server for standalone usage in production or development environment.
 * This action is designed to give an automated process the option to bootstrap a server with particular settings.
 * Note that once a server has been bootstrapped, it may not be added passively into a cluster using clusterAddServer.
 * It may still join a cluster using a direct WebAPI -serverAddToCluster, or a UI call.
 * This WebAPI action is explicitly accessible without a WebAPI Key, but only during the bootstrap stage.
 * Unlike the UI bootstrap/launching process, this bootstrap action does not restart Zend Server nor perform any authentication.
 * A WebAPI key with administrative permissions is created as part of the bootstrap process so that you may immediately continue working.
 * It is up to the user to decide what to do with this key once the bootstrap is completed.
 * Read a certain number of log lines from the end of the file log.
 * If serverId is passed, then the request will be performed against that cluster member, otherwise it is performed locally.
 * 
 * Version: 1.3
 * Required Permissions: Bootstrap
 * HTTP method: POST
 * Supported by Editions: All
 * @author sophpie
 *
 */
class BootstrapSingleServer extends ServiceAbstract
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->httpMethod = self::HTTP_METHOD_POST;
		$this->uriPath = 'bootstrapSingleServer';
		$this->version = '1.3';
		$this->addParameter(new ApiParameter('production', ApiParameter::TYPE_BOOLEAN));
		$this->addParameter(new ApiParameter('adminPassword', ApiParameter::TYPE_STRING,true));
		$this->addParameter(new ApiParameter('applicationUrl', ApiParameter::TYPE_STRING));
		$this->addParameter(new ApiParameter('adminEmail', ApiParameter::TYPE_STRING));
		$this->addParameter(new ApiParameter('developerPassword', ApiParameter::TYPE_STRING));
		$this->addParameter(new ApiParameter('orderNumber', ApiParameter::TYPE_STRING));
		$this->addParameter(new ApiParameter('licenseKey', ApiParameter::TYPE_STRING));
		$this->addParameter(new ApiParameter('acceptEula', ApiParameter::TYPE_BOOLEAN,true));
	}
}