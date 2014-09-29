<?php
namespace ZendPattern\Zsf\Configuration\Model;

class Component
{
	/**
	 * Linked extension
	 * @var Extension
	 */
	private $extension;
	
	/**
	 * Linked daemon
	 * @var Daemon
	 */
	private $daemon;
	
	/**
	 * @return the $extension
	 */
	public function getExtension() {
		return $this->extension;
	}

	/**
	 * @param \ZendPattern\Zsf\Configuration\Model\Extension $extension
	 */
	public function setExtension($extension) {
		$this->extension = $extension;
	}
	
	/**
	 * @return the $daemon
	 */
	public function getDaemon() {
		return $this->daemon;
	}

	/**
	 * @param \ZendPattern\Zsf\Configuration\Model\Daemon $daemon
	 */
	public function setDaemon($daemon) {
		$this->daemon = $daemon;
	}


}