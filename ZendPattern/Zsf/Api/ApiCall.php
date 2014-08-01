<?php
namespace ZendPattern\Zsf\Api;

use ZendPattern\Zsf\Feature\FeatureAbstract;
use Zend\EventManager\EventManager;
use Zend\Http\Client;
use ZendPattern\Zsf\Api\ApiCallEvent;
use Zend\ServiceManager\ServiceManager;
use ZendPattern\Zsf\Api\Service\ApiServiceAbstractFactory;
use ZendPattern\Zsf\Api\Listener\SecurityListener;
use ZendPattern\Zsf\Api\Listener\HeadersListener;
use ZendPattern\Zsf\Api\Listener\PrepareRequestListener;
use ZendPattern\Zsf\Api\Listener\RequestContentListener;
use ZendPattern\Zsf\Api\Listener\ResponseListener;
use ZendPattern\Zsf\Exception\Exception;
use ZendPattern\Zsf\Api\Service\ApiServiceAbstract;
use Zend\Stdlib\Parameters;
							
/**
 * Feature that allows to call a Zend Server API service
 */
 class ApiCall extends FeatureAbstract
{
	const EVENT_CHECK_SECURITY = 'check_security';
	const EVENT_SET_REQUEST = 'set_request';
	const EVENT_SEND_REQUEST = 'send_request';
	
	/**
	 * Event manager
	 * 
	 * @var EventManager
	 */
	protected $eventManager;
	
	/**
	 * Api event
	 * 
	 * @var ApiServiceEvent
	 */
	protected $event;
	
	/**
	 * Api Services manager
	 * 
	 * @var ServiceManager
	 */
	protected $serviceManager;
	
	/**
	 * Api key name to uses
	 * 
	 * @var string
	 */
	protected $apiKeyName = 'admin';
	
	/**
	 * Http Client to use
	 * 
	 * @var Client
	 */
	protected $httpClient;
	
	/**
	 * Api call parameters
	 * 
	 * @var array of ApiParameter
	 */
	protected $parameters = array();
	
	/**
	 * Api service name to be called
	 * 
	 * @var string
	 */
	protected $apiServiceName;
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Feature\FeatureAbstract::__invoke()
	 * 
	 * @param string api service name
	 * @param array api parameters
	 * @param string api key name
	 * @param Client HTTP client
	 */
	public function __invoke($args)
	{
		$this->setApiServiceName($args[0]);
		$apiService = $this->getServiceManager()->get($this->getApiServiceName());
		$event = $this->getEvent();
		$event->setApiCall($this);
		$event->setApiService($apiService);
		//Check service availability
		$event->setName(self::EVENT_CHECK_SECURITY);
		$securityListener = new SecurityListener();
		$this->getEventManager()->attach(self::EVENT_CHECK_SECURITY,array($securityListener,'checkServerEdition'));
		$this->getEventManager()->attach(self::EVENT_CHECK_SECURITY,array($securityListener,'checkApiVersion'));
		$this->getEventManager()->attach(self::EVENT_CHECK_SECURITY,array($securityListener,'checkApiNegotiation'));
		$securityChainResult = $this->getEventManager()->trigger($event,function($v){return ($v === false);});
		if ($securityChainResult->stopped()) throw new Exception('Security checks unsatisfied');
		//Manage request
		if (isset($args[1])) $this->setParameters($args[1]);
		if (isset($args[2])) $this->setApiKeyName($args[2]);
		if (isset($args[3])) $this->setHttpClient($args[3]);
		$requestListener = new PrepareRequestListener();
		$this->getEventManager()->attach(self::EVENT_SET_REQUEST,array($requestListener,'createRequest'),10);
		$this->getEventManager()->attach(self::EVENT_SET_REQUEST,array($requestListener,'setGetParameters'));
		$this->getEventManager()->attach(self::EVENT_SET_REQUEST,array($requestListener,'setPostParameters'));
		$this->getEventManager()->attach(self::EVENT_SET_REQUEST,array($requestListener,'setFileParameters'));
		$requestContentListener = new RequestContentListener();
		$headersListener = new HeadersListener();
		$responseListener = new ResponseListener();
		$this->getEventManager()->attach(self::EVENT_SET_REQUEST,array($requestContentListener,'prepareBody'), -5);
		$this->getEventManager()->attach(self::EVENT_SET_REQUEST,array($headersListener,'computeHeaders'), -10);
		$this->getEventManager()->attach(self::EVENT_SEND_REQUEST,array($responseListener,'xmlResponseStrategy'));
		$this->getEventManager()->attach(self::EVENT_SEND_REQUEST,array($responseListener,'fileResponseStrategy'));
		$event->setName(self::EVENT_SET_REQUEST);
		$this->getEventManager()->trigger($event);
		$request = $this->getEvent()->getRequest();
		//Send request
		$client = $this->getHttpClient();
		$client->setRequest($request);
		$response = $client->send();
		$event->setName(self::EVENT_SEND_REQUEST);
		$event->setResponse($response);
		$this->getEventManager()->trigger($event,function($e){return $e;});
		$response = $this->getEvent()->getResponse();
		return $response;
	}
	
	/**
	 * @return the $eventManager
	 */
	public function getEventManager() {
		if ( ! $this->eventManager) $this->eventManager = new EventManager();
		return $this->eventManager;
	}

	/**
	 * @return the $httpClient
	 */
	public function getHttpClient() {
		if ( ! $this->httpClient) $this->httpClient = new Client();
		return $this->httpClient;
	}

	/**
	 * @param \Zend\EventManager\EventManager $eventManager
	 */
	public function setEventManager($eventManager) {
		$this->eventManager = $eventManager;
	}

	/**
	 * @param \Zend\Http\Client $httpClient
	 */
	public function setHttpClient($httpClient) {
		$this->httpClient = $httpClient;
	}
	/**
	 * @return the $event
	 */
	public function getEvent() {
		if ( ! $this->event) $this->event = new ApiCallEvent();
		return $this->event;
	}

	/**
	 * @param \ZendPattern\Zsf\Api\Service\ApiServiceEvent $event
	 */
	public function setEvent($event) {
		$this->event = $event;
	}
	/**
	 * @return the $apiKeyName
	 */
	public function getApiKeyName() {
		return $this->apiKeyName;
	}

	/**
	 * @param string $apiKeyName
	 */
	public function setApiKeyName($apiKeyName) {
		$this->apiKeyName = $apiKeyName;
	}
	/**
	 * @return the $serviceManager
	 */
	public function getServiceManager() {
		if ( ! $this->serviceManager) {
			$this->serviceManager = new ServiceManager();
			$this->serviceManager->addAbstractFactory(new ApiServiceAbstractFactory());
		}
		//@todo : check if abstract factory is instanciate
		return $this->serviceManager;
	}

	/**
	 * @param \Zend\ServiceManager\ServiceManager $serviceManager
	 */
	public function setServiceManager($serviceManager) {
		$this->serviceManager = $serviceManager;
	}
	/**
	 * @return the $parameters
	 */
	public function getParameters() {
		return $this->parameters;
	}

	/**
	 * @param \ZendPattern\Zsf\Api\ApiParameter $parameters
	 */
	public function setParameters(array $parameters) {
		
		$apiServiceParameters = $this->getServiceManager()
			->get($this->getApiServiceName())
			->getParameters();
		foreach ($parameters as $name => $value){
			if ( ! array_key_exists($name,$apiServiceParameters)) throw new Exception($name . ' is not allowed');
		}
		foreach ($apiServiceParameters as $name => $param)
		{
			if ($param->isRequired() &&  ! isset($parameters[$name])) throw new Exception($name . ' is required');
			if (isset($parameters[$name])) $apiServiceParameters[$name]->setValue($parameters[$name]);
		}
		$this->parameters = $apiServiceParameters;
	}
	
	/**
	 * @return the $apiServiceName
	 */
	public function getApiServiceName() {
		return $this->apiServiceName;
	}

	/**
	 * @param string $apiServiceName
	 */
	public function setApiServiceName($apiServiceName) {
		$this->apiServiceName = $apiServiceName;
	}



}