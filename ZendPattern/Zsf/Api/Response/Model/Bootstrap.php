<?php
namespace ZendPattern\Zsf\Api\Response\Model;

use ZendPattern\Zsf\Api\Key\Key;
/**
 * Bootstrap object
 * @author sophpie
 *
 */
final class BootStrap
{
	/**
	 * Checl if bootstrap state is "bootstraped"
	 * @var boolean
	 */
	private $success = false;
	
	/**
	 * Api key
	 * @var Key
	 */
	private $key;
	
	/**
	 * @return the $key
	 */
	public function getKey() {
		return $this->key;
	}

	/**
	 * @param \ZendPattern\Zsf\Api\Key\Key $key
	 */
	public function setKey(Key $key) {
		$this->key = $key;
	}
	
	/**
	 * @return the $success
	 */
	public function getSuccess() {
		return $this->success;
	}

	/**
	 * @param boolean $success
	 */
	public function setSuccess($success) {
		$this->success = $success;
	}
}