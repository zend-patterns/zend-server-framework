<?php
namespace ZendPattern\Zsf\Api\Service\Listener;

use ZendPattern\Zsf\Api\Service\ApiServiceEvent;
use ZendPattern\Zsf\Api\Response\ResponseXml;
use ZendPattern\Zsf\Exception\Exception;
use ZendPattern\Zsf\Api\Response\ResponseFile;

class ResponseListener
{
	/**
	 * Manage Xml api response
	 *
	 * @param ResponseApi $response
	 * @throws Exception
	 * @return boolean
	 */
	public function xmlResponseStrategy(ApiServiceEvent $event)
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
	public function fileResponseStrategy(ApiServiceEvent $event)
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