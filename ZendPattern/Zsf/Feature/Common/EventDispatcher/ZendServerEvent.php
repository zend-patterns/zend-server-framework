<?php
namespace ZendPattern\Zsf\Feature\Common\EventDispatcher;

use Zend\EventManager\Event;
use ZendPattern\Zsf\Server\ServerInterface;
/**
 * Zend Server Event
 * 
 * @author sophpie
 *
 */
class ZendServerEvent extends Event
{
	/**
	 * Server that emmits the event
	 * 
	 * @var ServerInterface
	 */
	protected $server;
	
	/**
	 * @return the $server
	 */
	public function getServer() {
		return $this->server;
	}

	/**
	 * @param \ZendPattern\Zsf\Server\ServerInterface $server
	 */
	public function setServer($server) {
		$this->server = $server;
	}

}