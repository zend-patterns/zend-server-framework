<?php
namespace ZendPatter\Zsf\Message;

use ZendPattern\Zsf\Server\ZendServer;
use ZendPattern\Zsf\Server\ServerInterface;
use ZendPattern\Zsf\Message\ZSMessage;
/**
 * Zend job queue based message broker
 * @author sophpie
 *
 */
class ZSMessageBrocker
{
	/**
	 * Zend Server in charge of managing queue
	 * @var ZendServer
	 */
	private $zendServer;
	
	/**
	 * Reference to subscriber zend servers
	 * @var array
	 */
	private $subscribers = array();
	
	/**
	 * Message channels
	 * @var array
	 */
	private $channels = array();
	
	/**
	 * Add subscriber
	 * @param ServerInterface $ZServer
	 * @return boolean
	 */
	public function addSubscriber(ServerInterface &$ZServer)
	{
		if (in_array($ZServer, $this->subscribers)) return false;
		$this->subscribers[$ZServer->getName()] = $ZServer;
		return true;
	}
	
	public function publish(ZendServerMessage $message)
	{
	}
	
	/**
	 * @return the $zendServer
	 */
	public function getZendServer() {
		return $this->zendServer;
	}

	/**
	 * @param \ZendPattern\Zsf\Server\ZendServer $zendServer
	 */
	public function setZendServer($zendServer) {
		$this->zendServer = $zendServer;
	}

}