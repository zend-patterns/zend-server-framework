<?php
namespace ZendPattern\Zsf\Api\Listener;

use ZendPattern\Zsf\Api\ApiCallEvent;
use Zend\EventManager\ListenerAggregateInterface;
use ZendPattern\Zsf\Api\ApiCall;
use Zend\EventManager\EventManagerInterface;

class HeadersListener implements ListenerAggregateInterface
{
	const USER_AGENT = 'Zend\Http\Client';
	
	/**
	 *
	 * @param EventManagerInterface $event
	 */
	public function attach(EventManagerInterface $events)
	{
		$events->attach(ApiCall::EVENT_SET_REQUEST,array($this,'computeHeaders'), -10);
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
	 * Prepare the request before it been send to Zend Server
	 */
	public function computeHeaders(ApiCallEvent $event)
	{
		$request = $event->getRequest();
		$signature = self::computeSignature($request);
		$date = gmdate('D, d M Y H:i:s ') . 'GMT';
		$headers = $request->getHeaders();
		$headers->addHeaderLine('Host', $request->getUri()->getHost() . ':' . $request->getUri()->getPort());
		$headers->addHeaderLine('Date', $date);
		//$headers->addHeaderLine('Accept', 'application/vnd.zend.serverapi+xml;version=' . $request->getServer()->getApiVersion());
		//Case of bootStrapSingleServer.
		if ($request->getUri()->getPath() != '/ZendServer/api/bootstrapSingleServer') {
			$headers->addHeaderLine('X-Zend-Signature', $request->getApiKey()->getName() . '; ' . $signature);
		}
		if ($request->isPost()) {
			$contentLength = 0;
			if(count($request->getFiles())) {
				$headers->addHeaderLine('Content-Type', 'multipart/form-data, boundary=' . $event->getMultiPartBoundary());
			} else {
				$headers->addHeaderLine('Content-Type', 'application/x-www-form-urlencoded');
			}
			$contentLength += strlen($request->getContent());
			$headers->addHeaderLine('Content-Length',$contentLength);
		}
		$request->setHeaders($headers);
		$event->setRequest($request);
	}
	
	/**
	 *
	 * @param unknown ApiRequest $requestUri
	 */
	public static function computeSignature($requestUri)
	{
		$date = gmdate('D, d M Y H:i:s ') . 'GMT';
		$webApiUri = $requestUri->getUri()->getPath();
		//Case of bootStrapSingleServer.
		if ($webApiUri == '/ZendServer/api/bootstrapSingleServer') return '';
		$signatureData  = $requestUri->getUri()->getHost() . ':';
		$signatureData .= $requestUri->getUri()->getPort() . ':';
		$signatureData .= $webApiUri . ':';
		$signatureData .= self::USER_AGENT . ':';
		$signatureData .= $date;
		$apiKey = $requestUri->getApiKey();
		$signature = hash_hmac('sha256', $signatureData, $apiKey->getHash());
		return $signature;
	}
}
