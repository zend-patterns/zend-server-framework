<?php
namespace ZendPattern\Zsf\Api\Listener;

use ZendPattern\Zsf\Api\ApiRequest;
use ZendPattern\Zsf\Api\ApiCallEvent;
use Zend\Stdlib\Parameters;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManagerInterface;
use ZendPattern\Zsf\Api\ApiCall;

class PrepareRequestListener implements ListenerAggregateInterface
{
	/**
	 *
	 * @param EventManagerInterface $event
	 */
	public function attach(EventManagerInterface $events)
	{
		$events->attach(ApiCall::EVENT_SET_REQUEST,array($this,'createRequest'),10);
		$events->attach(ApiCall::EVENT_SET_REQUEST,array($this,'setGetParameters'));
		$events->attach(ApiCall::EVENT_SET_REQUEST,array($this,'setPostParameters'));
		$events->attach(ApiCall::EVENT_SET_REQUEST,array($this,'setFileParameters'));
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
	 * Create base API service Request
	 * 
	 * @param ApiServiceEvent $event
	 */
	public function createRequest(ApiCallEvent $event)
	{
		$server = $event->getApiCall()->getServer();
		$uriPath = $event->getApiService()->getUriPath();
		$request = new ApiRequest();
		$request->setServer($server);
		$request->setMethod($event->getApiService()->getHttpMethod());
		$request->setApiKeyName($event->getApiCall()->getApiKeyName());
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
	public function setGetParameters(ApiCallEvent $event)
	{
		$parameters = $event->getApiCall()->getParameters();
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
	 * Set POST parameters
	 *
	 * @param ApiServiceEvent
	 */
	public function setPostParameters(ApiCallEvent $event)
	{
		$parameters = $event->getApiCall()->getParameters();
		$request = $event->getRequest();
		if ( ! $request->isPost() || count($parameters) == 0) return;
		$post = new Parameters();
		foreach ($parameters as $name => $param){
			if ($param->isScalar()){
				$post->set($name, $param->getValue());
			}
		}
		$request->setPost($post);
		$event->setRequest($request);
	}
	
	/**
	 * Set File parameters
	 *
	 * @param ApiServiceEvent
	 */
	public function setFileParameters(ApiCallEvent $event)
	{
		$parameters = $event->getApiCall()->getParameters();
		$request = $event->getRequest();
		if ( ! $request->isPost() || count($parameters) == 0) return;
		$files = new Parameters();
		foreach ($parameters as $name => $param){
			if ( ! $param->isFile()) continue;
			$file = array(
				'ctype' => 'application/zip',
				'data' => file_get_contents($param->getValue()),
				'filename' => $param->getValue(),
				'formname' => $name,
			);
			$files->set($name,$file);
		}
		$request->setFiles($files);
		$event->setRequest($request);
	}
}