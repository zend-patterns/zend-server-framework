<?php
namespace ZendPattern\Zsf\Api\Client;

use Zend\Http\Client;
use ZendPattern\Zsf\Api\ApiRequest;
use Zend\Http\Headers;
use Zend\Http\Request;

abstract class ApiClientAbstract extends Client
{
	const USER_AGENT = 'Zend\Http\Client';
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Http\Client::send()
	 */
	public function send(Request $request = null)
	{
		if ($request !== null) {
			$this->setRequest($request);
		}
		$this->prepareRequest();
		return parent::send($request);
	}
	
	/**
	 * Prepare the request before it been send to Zend Server
	 */
	public function prepareRequest()
	{
		$signature = self::computeSignature($this->request);
		$date = gmdate('D, d M Y H:i:s ') . 'GMT';
		$headers = new Headers();
		$headers->addHeaderLine('Host', $this->request->getUri()->getHost() . ':' . $this->request->getUri()->getPort());
		$headers->addHeaderLine('Date', $date);
		$headers->addHeaderLine('Accept', 'application/vnd.zend.serverapi+xml;version=' . $this->request->getServer()->getApiVersion());
		$headers->addHeaderLine('X-Zend-Signature', $this->request->getApiKey()->getName() . '; ' . $signature);
		if ($this->request->isPost()) {
			$contentLength = 0;
			if(count($this->request->getFiles())) {
				$headers->addHeaderLine('Content-Type', 'multipart/form-data');
			} else {
				$headers->addHeaderLine('Content-Type', 'application/x-www-form-urlencoded');
			}
			$contentLength += strlen($this->getContent());
			$headers->addHeaderLine('Content-Length',$contentLength);
		}
		$this->request->setHeaders($headers);
	}
	
	/**
	 * 
	 * @param unknown ApiRequest $requestUri
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