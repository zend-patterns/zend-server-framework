# Zend Server Framework
## Introduction
The main goal of this framework is to provide a simple way to manage Zend Server instances through PHP applications.
Server instances will now be simple PHP objets on which you can add features. These features are plugins you can make by yourselves or provided by the framework itself.
Among internal features, web API plugin called "ApiCall" is the most important.
By example, to get the list of all API keys available you will just have to call :
`$zendserver->apiCall('apiKeysGetList');`

## Create a Server Instance
At first you should have install a Zend Server somewhere in a place available through http connections. Lets say that the Zend Server you want to instanciate in your PHP application is setted on http://www.myzendserver:10081.
To create your PHP Zend Server instance you just have to :

	use ZendPattern\Zsf\Server\ZendServer6;
	$zendServer = new ZendServer6('http://www.myzendserver:10081');
	


## Web API implementation
All API service inherite from ZendPattern\Zsf\Api\Service\ApiServiceAbstract.
To implemente a native Zend Server web API service (one among those provide by Zend Server itself) create a new class. By example to implemente "applicationDefine" service :

* create a class called "ApplicationDefine" in ZendPattern\Zsf\Api\Service\ZendServer namespace.
* Create a simple constructor in with you define service properties :
	
		public function __construct()
		{
			$this->httpMethod = self::HTTP_METHOD_POST;
			$this->apiVersion = '1.2';
			$this->uriPath = 'applicationDeploy';
			$this->addParameter(new ApiParameter('name', ApiParameter::TYPE_FILE,true));
			$this->addParameter(new ApiParameter('baseUrl', ApiParameter::TYPE_STRING,true));
			$this->addParameter(new ApiParameter('version', ApiParameter::TYPE_STRING));
			$this->addParameter(new ApiParameter('healthCheck', ApiParameter::TYPE_STRING);
			$this->addParameter(new ApiParameter('logo', ApiParameter::TYPE_FILE));
		}	
	
* Some explanation about ApiService classes :
	* $this->httpMethod : GET or POST depending on which HTTP method to use to call service.
	* $this->apiVersion : first API version in which this service is available
	* $this->uriPath : the URI path to call the service on Zend Server (http://localhost:10081/ZendServer/api/<uriPath)
	* $this->addParameter() is a methode to define APi service parameters. ApiParameter constructor needs parameters :
		* the name of the parameter (string)
		* the type of parameter which is one of the ApiParameter constants :  TYPE_FILE, TYPE_STRING, TYPE-BOOLEAN or TYPE_ARRAY
		* A booelan to set if parameter is required or not.
