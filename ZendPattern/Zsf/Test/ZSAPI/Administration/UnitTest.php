<?php
namespace Test\ZSAPI\Administration;

use ZendPattern\Zsf\Server\ZendServer6;
use ZendPattern\Zsf\Server\WebInterface;
use ZendPattern\Zsf\Api\Key\Key;
use ZendPattern\Zsf\Api\Service\ZendServer\Deployment\ApplicationDeploy;
use ZendPattern\Zsf\Api\ApiCall;

class UnitTest extends \PHPUnit_Framework_TestCase
{
	protected $zendServer;
	
	static $ZSconfig;
	
	public static function setUpBeforeClass()
	{
		self::$ZSconfig = include TESTDIR . '/config/zendserver.config.php';
	}
	
	/**
	 * (non-PHPdoc)
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	public function setUp()
	{
		$this->zendServer = new ZendServer6();
		$this->zendServer->addFeature(new ApiCall());
		$webInterface = new WebInterface(self::$ZSconfig['rootUri']);
		$this->zendServer->setWebInterface($webInterface);
		$apiKey = new Key(self::$ZSconfig['keyName'], self::$ZSconfig['keyHash']);
		$this->zendServer->getKeyManager()->addApiKey($apiKey,true);
	}
	
	/**
	 * @test
	 */
	public function ApiKeyGetList()
	{
		$response = $this->zendServer->apiCall('apiKeysGetList');
		//var_dump($response->getInnerResponse()->getBody());
	}
	
	/**
	 * @test
	 */
	public function GetSystemInfo()
	{
		$response = $this->zendServer->apiCall('getSystemInfo');
		var_dump($response->getInnerResponse()->getBody());
	}
	
	/**
	 * @_test
	 */
	public function ApplicationDeploy()
	{
		$response = $this->zendServer->apiCall(
			'applicationDeploy',
			array(
				'appPackage' => TESTDIR . '/data/phpMyAdmin-4.0.5.4.zpk',
				'baseUrl' => 'http://<default-server>',
				'defaultServer' => true,
			)
		);
		var_dump($response->getInnerResponse()->getBody());
	}
}