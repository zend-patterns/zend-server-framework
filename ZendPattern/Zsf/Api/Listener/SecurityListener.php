<?php
namespace ZendPattern\Zsf\Api\Listener;

use ZendPattern\Zsf\Api\ApiCallEvent;

class SecurityListener
{
	/**
	 * Check if requested service is available in server edition
	 * 
	 * 
	 * @param ApiServiceEvent $event
	 */
	public function checkServerEdition(ApiCallEvent $event)
	{
		return true;
	}
	
	/**
	 * Check if requested service is availble in the given api vervion
	 * 
	 * @param ApiServiceEvent $event
	 */
	public function checkApiVersion(ApiCallEvent $event)
	{
		$serviceMinimalApiVersion = $event->getApiService()->getApiVersion();
		$serverApiVersion = $event->getApiCall()->getServer()->getApiVersion();
		return (version_compare($serverApiVersion, $serviceMinimalApiVersion,'ge'));
	}
	
	/**
	 * Check if request is suitable for API
	 * 
	 * Will not bee used if requested service is a natural Zend Server Api service
	 * @param ApiServiceEvent $event
	 */
	public function checkApiNegotiation(ApiCallEvent $event)
	{
		return true;
	}
}