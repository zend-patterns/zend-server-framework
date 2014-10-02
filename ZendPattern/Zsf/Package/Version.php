<?php
namespace ZendPattern\Zsf\Package;

/**
 * Package version
 * @author sophpie
 *
 */
class Version
{
	/**
	 * Release number
	 * @var string
	 */
	private $release = '0.0';
	
	/**
	 * Api version
	 * @var string
	 */
	private $api;
	
	/**
	 * @return the $release
	 */
	public function getRelease() {
		return $this->release;
	}

	/**
	 * @return the $api
	 */
	public function getApi() {
		return $this->api;
	}

	/**
	 * @param string $release
	 */
	public function setRelease($release) {
		$this->release = $release;
	}

	/**
	 * @param string $api
	 */
	public function setApi($api) {
		$this->api = $api;
	}

}
