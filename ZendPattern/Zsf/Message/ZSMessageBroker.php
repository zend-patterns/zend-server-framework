<?php
namespace ZendPattern\Zsf\Message;

use ZendPattern\Zsf\Server\ZendServer;
use ZendPattern\Zsf\Server\ServerInterface;
use ZendPattern\Zsf\Message\ZSMessage;
use ZendPattern\Zsf\Model\Job\Job;
/**
 * Zend job queue based message broker
 * @author sophpie
 *
 */
class ZSMessageBroker
{
	const SERVICE_KEY = 'Zsf\Message\ZSMessageBroker';
	const CONFIG_KEY = 'Zsf\Message\ZSMessageBroker\Config';
	
	/**
	 * Zend Server in charge of managing queue
	 * @var ZendServer
	 */
	private $zendServer;
	
	/**
	 * Root URL of Zend Farm application
	 * @var string
	 */
	private $rootUrl;
	
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
	
	/**
	 * Publish message in queue
	 * @param ZSMessageInterface $message
	 */
	public function publish(ZSMessageInterface $message)
	{
		$messageJob =new Job();
		$script = trim($this->getRootUrl(),'/');
		$script.= '/zsf/messaging';
		$messageJob->setScript($script);
		$vars = array('message' => $message->getContent());
		$this->zendServer->createJob($messageJob,$vars);
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
	
	/**
	 * @return the $rootUrl
	 */
	public function getRootUrl() {
		return $this->rootUrl;
	}

	/**
	 * @param string $rootUrl
	 */
	public function setRootUrl($rootUrl) {
		$this->rootUrl = $rootUrl;
	}
}