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
use ZendPattern\Zsf\Api\Listener\ResponseModelListener;
use Zend\Http\Client\Adapter\Curl;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
											
/**
 * Feature that allows to call a Zend Server API service
 */
 class ApiCall extends FeatureAbstract implements ServiceLocatorAwareInterface
{
	const EVENT_CHECK_SECURITY = 'check_security';
	const EVENT_SET_REQUEST = 'set_request';
	const EVENT_SEND_REQUEST = 'send_request';
	const EVENT_RESPONSE = 'response';
	
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
	 * Listener in charge of computing API request headers
	 * @var HeadersListener
	 */
	protected $headerListener;
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->setMinimalZSVersion('5.1.0');
		$this->headerListener = new HeadersListener();
		$responseModelListener = new ResponseModelListener();
		$responseListener = new ResponseListener();
		$securityListener = new SecurityListener();
		$requestListener = new PrepareRequestListener();
		$requestContentListener = new RequestContentListener();
		$responseModelListener->attach($this->getEventManager());
		$responseListener->attach($this->getEventManager());
		$securityListener->attach($this->getEventManager());
		$requestListener->attach($this->getEventManager());
		$requestContentListener->attach($this->getEventManager());
		$this->headerListener->attach($this->getEventManager());
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Feature\FeatureAbstract::__invoke()
	 * 
	 * @param string  : api service name
	 * @param array   : api parameters
	 * @param string  : api key name
	 * @param Client  : HTTP client
	 */
	public function __invoke($args)
	{
		$this->setApiServiceName($args[0]);
		if ($this->getApiServiceName() == 'bootstrapSingleServer')
		{
			$this->headerListener->detachSignature($this->getEventManager());
		}
		$apiService = $this->getServiceLocator()->get($this->getApiServiceName());
		$event = $this->getEvent();
		$event->setApiCall($this);
		$event->setApiService($apiService);
		//Check service availability
		$event->setName(self::EVENT_CHECK_SECURITY);
		$securityChainResult = $this->getEventManager()->trigger($event,function($v){return ($v === false);});
		if ($securityChainResult->stopped()) throw new Exception('Security checks unsatisfied');
		//Manage request
		if (isset($args[1])) $this->setParameters($args[1]);
		if (isset($args[2])) $this->setApiKeyName($args[2]);
		if (isset($args[3])) $this->setHttpClient($args[3]);
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
		$event->setName(self::EVENT_RESPONSE);
		$this->getEventManager()->trigger($event);
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
	public function getServiceLocator() {
		return $this->serviceManager;
	}

	/**
	 * @param \Zend\ServiceManager\ServiceManager $serviceManager
	 */
	public function setServiceLocator(ServiceLocatorInterface $serviceManager) {
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