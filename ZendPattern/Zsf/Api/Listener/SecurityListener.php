<?php
namespace ZendPattern\Zsf\Api\Listener;

use ZendPattern\Zsf\Api\ApiCallEvent;
use Zend\EventManager\ListenerAggregateInterface;
use ZendPattern\Zsf\Api\ApiCall;
use Zend\EventManager\EventManagerInterface;

class SecurityListener implements ListenerAggregateInterface
{
	/**
	 *
	 * @param EventManagerInterface $event
	 */
	public function attach(EventManagerInterface $events)
	{
		$events->attach(ApiCall::EVENT_CHECK_SECURITY,array($this,'checkServerEdition'));
		$events->attach(ApiCall::EVENT_CHECK_SECURITY,array($this,'checkApiVersion'));
		$events->attach(ApiCall::EVENT_CHECK_SECURITY,array($this,'checkApiNegotiation'));
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\EventManager\ListenerAggregateInterface::detach()
	 */
	public function detach(EventManagerInterface $events)
	{
		$events->detach($this);
		return $this;
	}
	
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