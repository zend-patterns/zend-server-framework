<?php
namespace ZendPattern\Zsf\Api\Service\Listener;

use ZendPattern\Zsf\Api\ApiRequest;
use ZendPattern\Zsf\Api\Service\ApiServiceEvent;
use Zend\Stdlib\Parameters;

class PrepareRequestListener
{
	/**
	 * Create base API service Request
	 * 
	 * @param ApiServiceEvent $event
	 */
	public function createRequest(ApiServiceEvent $event)
	{
		$server = $event->getService()->getServer();
		$uriPath = $event->getService()->getUriPath();
		$request = new ApiRequest();
		$request->setServer($server);
		$request->setMethod($event->getService()->getHttpMethod());
		$request->setApiKeyName($event->getService()->getApiKeyName());
		$apiUri = $server->getWebInterface()->getApiUri();
		$request->setUri($apiUri);
		$path = $request->getUri()->getPath();
		$path .= '/' . trim($uriPath,'/');
		$request->getUri()->setPath($path);
		$event->setRequest($request);
	}
	
	/**
	 * Set GET query parameters
	 *
	 * @param ApiServiceEvent
	 */
	public function setGetParameters(ApiServiceEvent $event)
	{
		$parameters = $event->getService()->getParameters();
		$request = $event->getRequest();
		if ( ! $request->isGet() || count($parameters) == 0) return;
		$query = new Parameters();
		foreach ($parameters as $name => $param){
			if ($param->isScalar()){
				if ($param->getValue() === null) continue;
				$query->set($name, $param->getValue());
			}
		}
		$request->setQuery($query);
		$event->setRequest($request);
	}
	
	/**
	 * Set POST parameter
	 *
	 * @param ApiServiceEvent
	 */
	public function setPostParameters(ApiServiceEvent $event)
	{
		$parameters = $event->getService()->getParameters();
		$request = $event->getRequest();
		if ( ! $request->isPost() ||count($parameters) == 0) return;
		$post = new Parameters();
		foreach ($parameters as $name => $param){
			if ($param->isScalar()){
				$post->set($name, $param->getValue());
			}
		}
		$request->setPost($post);
		$event->setRequest($request);
	}
}