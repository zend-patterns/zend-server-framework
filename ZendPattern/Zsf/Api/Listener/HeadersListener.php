<?php
namespace ZendPattern\Zsf\Api\Listener;

use ZendPattern\Zsf\Api\ApiCallEvent;
use Zend\EventManager\ListenerAggregateInterface;
use ZendPattern\Zsf\Api\ApiCall;
use Zend\EventManager\EventManagerInterface;
use Zend\Stdlib\CallbackHandler;
/**
 * Listener in charge of computing headers if API request
 * 
 * Also in charge of inject headers into request.
 * @author sophpie
 *
 */
class HeadersListener implements ListenerAggregateInterface
{
	const USER_AGENT = 'Zend\Http\Client';
	
	/**
	 * Callback handler fro addSignature listener
	 * @var CallbackHandler
	 */
	protected $addSignatureCallbackHandler;
	
	/**
	 *
	 * @param EventManagerInterface $event
	 */
	public function attach(EventManagerInterface $events)
	{
		$events->attach(ApiCall::EVENT_SET_REQUEST,array($this,'computeHeaders'), -10);
		$this->addSignatureCallbackHandler = $events->attach(ApiCall::EVENT_SET_REQUEST,array($this,'addSignature'), -20);
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
	 * Detach signature header listener
	 * 
	 * @param EventManagerInterface $events
	 */
	public function detachSignature(EventManagerInterface $events)
	{
		$events->detach($this->addSignatureCallbackHandler);
	}
	
	/**
	 * Prepare the request before it been send to Zend Server
	 */
	public function computeHeaders(ApiCallEvent $event)
	{
		$request = $event->getRequest();
		$date = gmdate('D, d M Y H:i:s ') . 'GMT';
		$headers = $request->getHeaders();
		$headers->addHeaderLine('Host', $request->getUri()->getHost() . ':' . $request->getUri()->getPort());
		$headers->addHeaderLine('Date', $date);
		$headers->addHeaderLine('Accept', 'application/vnd.zend.serverapi+xml;version=' . $request->getServer()->getApiVersion());
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
	 * Add Zend signature to headers
	 * 
	 * @param ApiCall $event
	 */
	public function addSignature(ApiCallEvent $event)
	{
		$request = $event->getRequest();
		$signature = self::computeSignature($request);
		$headers = $request->getHeaders();
		$headers->addHeaderLine('X-Zend-Signature', $request->getApiKey()->getName() . '; ' . $signature);
	}
	
	/**
	 *Compute zend Api request signature.
	 *
	 * @param ApiRequest $requestUri
	 */
	public static function computeSignature($requestUri)
	{
		$date = gmdate('D, d M Y H:i:s ') . 'GMT';
		$webApiUri = $requestUri->getUri()->getPath();
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
