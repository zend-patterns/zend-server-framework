<?php
namespace ZendPattern\Zsf\Api\Service;

use ZendPattern\Zsf\Feature\FeatureAbstract;
use ZendPattern\Zsf\Api\Client\ApiClientInterface;
use ZendPattern\Zsf\Api\Key\Key;
use ZendPattern\Zsf\Exception\Exception;
use ZendPattern\Zsf\Api\ApiParameter;
use Zend\EventManager\EventManager;
use Zend\EventManager\Event;
use ZendPattern\Zsf\Api\Service\Listener\PrepareRequestListener;
use ZendPattern\Zsf\Api\Service\Listener\ResponseListener;
use Zend\Http\Client;
use ZendPattern\Zsf\Api\Service\Listener\RequestContentListener;
use ZendPattern\Zsf\Api\Service\Listener\HeadersListener;

/**
 * Abstract class for all Zend Server web API services.
 * Service abstract inherit from Zend Server feature.
 * @author sophpie
 */
abstract class ServiceAbstract extends FeatureAbstract
{
	const HTTP_METHOD_GET = 'GET';
	const HTTP_METHOD_POST = 'POST';
	
	const PERMISSION_READ = 'read';
	
	const EVENT_REQUEST = 'request';
	const EVENT_RESPONSE = 'response';
	
	/**
	 * HTTP method GET | POST
	 * 
	 * @var string
	 */
	protected $httpMethod;
	
	/**
	 * Parameter
	 * 
	 * @var array of ApiParameter
	 */
	protected $parameters = array();
	
	/**
	 * Required permission
	 * 
	 * @var string
	 */
	protected $requiredPermission;
	
	/**
	 * Uri path of service
	 * 
	 * @var string
	 */
	protected $uriPath;
	
	/**
	 * Http client
	 * 
	 * @var ApiClientClient
	 */
	protected $httpClient;
	
	/**
	 * Api Key name
	 * 
	 * @var string
	 */
	protected $apiKeyName = 'admin';
	
	/**
	 * Event manager
	 * 
	 * @var EventManager
	 */
	protected $eventManager;
	
	/**
	 * Event
	 * @var Event
	 */
	protected $event;

	/**
	 * @return the $event
	 */
	public function getEvent() {
		if ( ! $this->event){
			$this->event = new ApiServiceEvent();
		}
		return $this->event;
	}

	/**
	 * @param \Zend\EventManager\Event $event
	 */
	public function setEvent($event) {
		$this->event = $event;
	}

	/**
	 * @return the $eventManager
	 */
	public function getEventManager() {
		if ( ! $this->eventManager) {
			$this->eventManager = new EventManager();
		}
		return $this->eventManager;
	}

	/**
	 * @param \Zend\EventManager\EventManager $eventManager
	 */
	public function setEventManager($eventManager) {
		$this->eventManager = $eventManager;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Feature\FeatureAbstract::getResourceId()
	 */
	public function getResourceId()
	{
		$resourceId = $this->getName() . '-' . $this->server->getApiVersion();
		return $resourceId;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Feature\FeatureAbstract::__invoke()
	 * 
	 * @param array   0	: service parameters
	 * @param string  1	: api key name
	 * @param Client  2	: Api client to use
	 * @return Response;
	 */
	public function __invoke($args)
	{
		if (isset($args[1])) $this->setApiKeyName($args[1]);
		if (isset($args[2])) $this->setHttpClient($args[2]);
		if (isset($args[0])) $this->setParameters($args[0]);
		$requestListener = new PrepareRequestListener();
		$this->getEventManager()->attach(self::EVENT_REQUEST,array($requestListener,'createRequest'),10);
		$this->getEventManager()->attach(self::EVENT_REQUEST,array($requestListener,'setGetParameters'));
		$this->getEventManager()->attach(self::EVENT_REQUEST,array($requestListener,'setPostParameters'));
		$this->getEventManager()->attach(self::EVENT_REQUEST,array($requestListener,'setFileParameters'));
		$requestContentListener = new RequestContentListener();
		$headersListener = new HeadersListener();
		$responseListener = new ResponseListener();
		$this->getEventManager()->attach(self::EVENT_REQUEST,array($requestContentListener,'prepareBody'), -5);
		$this->getEventManager()->attach(self::EVENT_REQUEST,array($headersListener,'computeHeaders'), -10);
		$this->getEventManager()->attach(self::EVENT_RESPONSE,array($responseListener,'xmlResponseStrategy'));
		$this->getEventManager()->attach(self::EVENT_RESPONSE,array($responseListener,'fileResponseStrategy'));
		$event = $this->getEvent();
		$event->setService($this);
		$event->setName(self::EVENT_REQUEST);
		$this->getEventManager()->trigger($event);
		$request = $this->getEvent()->getRequest();
		$client = $this->getHttpClient();
		$client->setRequest($request);
		$response = $client->send();
		$event->setName(self::EVENT_RESPONSE);
		$event->setResponse($response);
		$this->getEventManager()->trigger($event,function($e){return $e;});
		$response = $this->getEvent()->getResponse();
		return $response;
	}
	
	/**
	 * Set custom Api Client
	 * 
	 * @param ApiClientInterface $client
	 */
	public function setHttpClient(ApiClientInterface $client)
	{
		$this->client = $client;
	}
	
	/**
	 * Get Http client
	 * 
	 * @return ApiClientInterface
	 */
	public function getHttpClient()
	{
		if ($this->httpClient) return $this->httpClient;
		$this->httpClient = new Client();
		return $this->httpClient;
	}
	
	/**
	 * Set api key name tu use
	 * 
	 * @param string $keyName
	 */
	public function setApiKeyName($keyName)
	{
		$this->apiKeyName = $keyName;
	}
	
	/**
	 * get Api key
	 * 
	 * @return Key
	 */
	public function getApiKeyName()
	{
		return $this->apiKeyName;
	}
	
	/**
	 * Add parameter
	 * 
	 * @param ApiParameter $apiParameter
	 */
	public function addParameter(ApiParameter $apiParameter)
	{
		$this->parameters[$apiParameter->getName()] = $apiParameter;
	}
	
	/**
	 * Set parameters
	 * 
	 * @param array $args
	 */
	protected function setParameters($args)
	{
		foreach ($args as $name => $value){
			if ( ! array_key_exists($name,$this->parameters)) throw new Exception($name . ' is not allowed');
		}
		foreach ($this->parameters as $name => $param)
		{
			if ($param->isRequired() &&  ! isset($args[$name])) throw new Exception($name . ' is required');
			if (isset($args[$name])) $this->parameters[$name]->setValue($args[$name]);
		}
	}
	
	/**
	 * @return the $uriPath
	 */
	public function getUriPath() {
		return $this->uriPath;
	}

	/**
	 * @param string $uriPath
	 */
	public function setUriPath($uriPath) {
		$this->uriPath = $uriPath;
	}
	/**
	 * @return the $parameters
	 */
	public function getParameters() {
		return $this->parameters;
	}
	
	/**
	 * @return the $httpMethod
	 */
	public function getHttpMethod() {
		return $this->httpMethod;
	}

	/**
	 * @param string $httpMethod
	 */
	public function setHttpMethod($httpMethod) {
		$this->httpMethod = $httpMethod;
	}
}