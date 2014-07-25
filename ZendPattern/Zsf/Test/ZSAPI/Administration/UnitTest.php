<?php
namespace Test\ZSAPI\Administration;

use ZendPattern\Zsf\Server\ZendServer6;
use ZendPattern\Zsf\Server\WebInterface;
use ZendPattern\Zsf\Api\Key\Key;

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
		$response = $this->zendServer->apiKeysGetList();
		var_dump($response->getInnerResponse()->getBody());
	}
}