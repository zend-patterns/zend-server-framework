<?php
namespace ZendPattern\Zsf\Api\Listener;

use ZendPattern\Zsf\Api\ApiCallEvent;
use ZendPattern\Zsf\Api\Response\ResponseXml;
use ZendPattern\Zsf\Exception\Exception;
use ZendPattern\Zsf\Api\Response\ResponseFile;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use ZendPattern\Zsf\Api\ApiCall;

class ResponseListener implements ListenerAggregateInterface
{
	/**
	 * 
	 * @param EventManagerInterface $event
	 */
	public function attach(EventManagerInterface $events)
	{
		$events->attach(ApiCall::EVENT_SEND_REQUEST,array($this,'errorStrategy'),0);
		$events->attach(ApiCall::EVENT_SEND_REQUEST,array($this,'xmlResponseStrategy'),-10);
		$events->attach(ApiCall::EVENT_SEND_REQUEST,array($this,'fileResponseStrategy'),-20);
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
	 * Manage Htt error strategy
	 * 
	 * @param ApiCallEvent $event
	 */
	public function errorStrategy(ApiCallEvent $event)
	{
		$response = $event->getResponse();
		$contentType = $response->getHeaders()->get('Content-Type')->getFieldValue();
		if ($contentType == 'text/html') {
			throw new Exception('Api return HTML content');
		}
	}
	
	/**
	 * Manage Xml api response
	 *
	 * @param ResponseApi $response
	 * @throws Exception
	 * @return boolean
	 */
	public function xmlResponseStrategy(ApiCallEvent $event)
	{
		$response = $event->getResponse();
		$contentType = $response->getHeaders()->get('Content-Type')->getFieldValue();
		if (preg_match('@^application/vnd\.zend\.serverapi\+xml@', $contentType) != 1) return false;
		$response = ResponseXml::factory($response);
		if ( ! $response->getInnerResponse()->isSuccess()){
			$message  = ' - Error: ' . $response->getApiErrorCode();
			$message .= ' - Reason: ' . $response->getApiErrorMessage();
			$message .= ' - ' . $response->getInnerResponse()->getBody();
			throw new Exception($message);
		}
		$event->setResponse($response);
		return true;
	}
	
	/**
	 * Manage file api response
	 *
	 * @param ApiServiceEvent
	 */
	public function fileResponseStrategy(ApiCallEvent $event)
	{
		$response = $event->getResponse();
		$contentType = $response->getHeaders()->get('Content-Type')->getFieldValue();
		if ( ! $contentType == 'application/zip') return false;
		if ( ! $contentType == 'application/x-amf') return false;
		if ( ! $contentType == 'application/vnd.zend.serverconfig') return false;
		$event->setResponse(ResponseFile::factory($response));
		return true;
	}
}