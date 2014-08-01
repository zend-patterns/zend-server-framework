# Zend Server Framework
## Introduction
The main goal of this framework is to provide a simple way to manage Zend Server instances through PHP applications.

## Create a Server Instance
At first you should have install a Zend Server somewhere in a place available through http connections. Lets say that the Zend Server you want to instanciate in your PHP application is setted on http://www.myzendserver.dev:10081.
To create your PHP Zend Server instance you just have to :

	$zendServer = new ZendPattern\Zsf\Server\ZendServer();

### Configure Zend Server instance
#### Use configuration array
To set most of Zend Server parameters use a configuration array

	$configugration =  array(
		'version' => '7.0.0',
		'edition' => 'ENTERPRISE',
		'uriPath' => 'http://www.myzendserver.dev:10081/',
		'apiPath' => 'ZendServer/Api',
		'apiKeys' => array(
			'admin' => '123896589...',
			'anykey' => '14596875...',
		),
	);
	
And use a configurator to set your Zend Server up :

	$configurator = new ZendPattern\Zsf\Server\Configurator();
	$configurator->configure($server,$configuration);
	
#### use auto-discovering
Zend Server is capabale of autodiscovering itself. All what you need to know is server URL and an API key :

	$zendserver = new ZendPattern\Zsf\Server\ZendServer();
	$zendserver->addFeature(new ZendPattern\Zsf\Feature\ZendServer6\AutoDiscover());
	$zendserver->setUriPath('http://www.myzendserver.dev:10081/');
	$zendserver->autoDiscover('admin','1235974896...');
	
Now your Zend Server is completly setted up.

## About Zend Server features
All Zend Server functionallities are implented has plugins we call "features". When you create a new Zend Server it has no feature installed and cannot do anything. 
To start adding feature simply use :

	$feature = new ZendPattern\Zsf\Feature\ZendServer6\AutoDiscover();
	$zendserver->addFeature($feature);
	
Zend Server framework is provided with some build-in features :
### apiCall ($serviceName, $serviceParams, $apiKeyName, $httpClient)
This feature is the one responsible of calling a web API service on Zend Server. By example we can call "getSystemInfo" service :

	$apiCallFeature = new ZendPattern\Zsf\Api\ApiCall();
	$zendserver->addFeature($apiCallFeature);
	$systemInfo = $zendserver->apicall('getSystemInfo');
	$xmlData = $systemInfo->getXmlContent();
	echo (string)$xmlData->responseData->systemInfo->edition;
	
The code above will result in `7.0.0`.

The feature parameters are : 

* $serviceName : name of called service
* $serviceParams : array of service parameter corresponding to GET or POST parameters you need to run the API call.
* $apiKeyName : name of the API key to use.If none provides, will use 'admin' key.
* $httpClient : a custom HTTP client.

Another example with "deployApplication" service :

	$zendServer->apiCall(
		'applicationDeploy',
		array(
			'appPackage' => 'phpMyAdmin-4.0.5.4.zpk',
			'baseUrl' => 'http://phpmyadmin.myzendserver.dev',
		)
	);
### AutoDiscoverApiKeys

### AutoDiscover

### Create you own features.
The best usage of feature is that you can add any feature you want on your Zend Server.

