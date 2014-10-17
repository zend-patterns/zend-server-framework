<?php
namespace ZendPattern\Zsf\Server;

class Farm
{
	/**
	 * Zend Server Manager
	 * @var ZendServerManager
	 */
	private $zsmanager;
	
	/**
	 * @return the $zsmanager
	 */
	public function getZsmanager() {
		return $this->zsmanager;
	}

	/**
	 * @param \ZendPattern\Zsf\Server\ZendServerManager $zsmanager
	 */
	public function setZsmanager($zsmanager) {
		$this->zsmanager = $zsmanager;
	}

}