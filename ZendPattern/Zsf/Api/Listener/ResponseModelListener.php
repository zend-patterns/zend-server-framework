<?php
namespace ZendPattern\Zsf\Api\Listener;

use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use ZendPattern\Zsf\Api\ApiCall;
use ZendPattern\Zsf\Api\ApiCallEvent;
use ZendPattern\Zsf\Api\Response\ResponseXml;
use ZendPattern\Zsf\Api\Response\ResponseModel;
/**
 * Listener in charge of generate response from APi as an object
 * based on Xml response
 * @author sophpie
 *
 */
class ResponseModelListener implements ListenerAggregateInterface
{
	/**
	 * Event manager
	 * 
	 * @var EventManagerInterface
	 */
	private $events;
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\EventManager\ListenerAggregateInterface::attach()
	 */
	public function attach(EventManagerInterface $events)
	{
		$events->attach(ApiCall::EVENT_RESPONSE,array($this,'hydrateFromXmlResponse'),-100);
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
	 * Converte Xml Response into a ResponseModel
	 * 
	 * @param ApiCallEvent $event
	 * @return boolean
	 */
	public function hydrateFromXmlResponse(ApiCallEvent $event)
	{
		$response = $event->getResponse();
		if ( ! $response instanceof ResponseXml) return false;
		$sm = $event->getApiCall()->getServiceManager();
		$modelGenerator = $sm->get('xmlModelGenerator');
		$object = $modelGenerator->getModel($response);
		if ( $object === false) return false;
		$event->setResponse($object);
		return true;
	}
}