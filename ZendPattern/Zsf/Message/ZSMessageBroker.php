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
	 * Reference to subscriber zend servers and the channems tey subscribe to
	 * array('<server_name>' => array(
	 *    'zserver => <zendServer_object>,
	 *    'channels' => <array_of_channels_name>
	 * ))
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
	public function addSubscriber(ServerInterface &$ZServer, $channels = array())
	{
		if (in_array($ZServer, $this->subscribers)) return false;
		$this->subscribers[$ZServer->getName()] = array(
				'zserver'  => $ZServer,
				'channels' => $channels,
		);
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
		$vars = array(
				'message' => serialize($message),
		);
		$this->zendServer->createJob($messageJob,$vars);
	}
	
	/**
	 * Get list of servers that have subscribe to givens channels
	 * @param array $channels
	 * @return array
	 */
	protected function getSubscribersTo(array $channels)
	{
		$subscribers = array();
		foreach ($this->subscribers as $serverName => $data){
			if (count(array_intersect($data['channels'], $channels)) > 0){
				array_push($subscribers,$serverName);
			}
		}
		return $subscribers;
	}
	
	/**
	 * Dispatch the messag eto subscribers
	 * @param ZSMessageInterface $message
	 */
	public function dispatch(ZSMessageInterface $message)
	{
		$messageChannels = $message->getHeader()->getChannels();
		$subscribers = $this->getSubscribersTo($messageChannels);
		foreach ($subscribers as $subscriber){
			$subscriber->triggerListeners();
		}
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