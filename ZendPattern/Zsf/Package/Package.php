<?php
namespace ZendPattern\Zsf\Package;

/**
 * Package is a facade to handle manifest and properties file
 * @author sophpie
 * @todo : add librairie deployment support
 */
class Package
{
	/**
	 * Deployment manifest
	 * @var Manifest
	 */
	private $manifest;
	
	/**
	 * Deployment properties
	 * @var Properties
	 */
	private $properties;
	
	/**
	 * Return package name
	 * @return string
	 */
	public function getName() {
		return $this->manifest->getName();
	}
	
	/**
	 * Returns package summary
	 * @return string
	 */
	public function getSummary() {
		return $this->manifest->getSummary();
	}
	
	/**
	 * Returns package description
	 * @return string
	 */
	public function getDescription() {
		return $this->manifest->getDescription();
	}
	
	/**
	 * Return package icon path
	 * @return string
	 */
	public function getIcon() {
		return $this->manifest->getIcon();
	}
	
	/**
	 * Returns license text file path
	 * @return string
	 */
	public function getEula() {
		return $this->manifest->getEula();
	}
	
	/**
	 * Returns package version
	 * @return Version
	 */
	public function getVersion() {
		return $this->manifest->getVersion();
	}
	
	/**
	 * Returns source file zpk directory
	 * @return string
	 */
	public function getAppdir() {
		return $this->manifest->getAppdir();
	}
	
	/**
	 * Return package docroot
	 * @return string
	 */
	public function getDocroot() {
		return $this->manifest->getDocroot();
	}
	
	/**
	 * Returns health check url
	 * @return string
	 */
	public function getHealthcheck() {
		return $this->manifest->getHealthcheck();
	}
	
	/**
	 * Set package name
	 * @param string $name
	 */
	public function setName($name) {
		$this->manifest->setName($name);
	}
	
	/**
	 * Set summary
	 * @param string $summary
	 */
	public function setSummary($summary) {
		$this->manifest->setSummary($summary);
	}
	
	/**
	 * Set descritpion
	 * @param string $description
	 */
	public function setDescription($description) {
		$this->manifest->setDescription($description);
	}
	
	/**
	 * Set Icon
	 * @param string $icon
	 */
	public function setIcon($icon) {
		$this->manifest->setIcon($icon);
	}
	
	/**
	 * Set license
	 * @param string $eula
	 */
	public function setEula($eula) {
		$this->setEula($eula);
	}
	
	/**
	 * Set Version
	 * @param \ZendPattern\Zsf\Package\Version $version
	 */
	public function setVersion($version) {
		$this->manifest->setVersion($version);
	}
	
	/**
	 * Set application source zpk directory
	 * @param string $appdir
	 */
	public function setAppdir($appdir) {
		$this->manifest->setAppdir($appdir);
	}
	
	/**
	 * Set docroot
	 * @param string $docroot
	 */
	public function setDocroot($docroot) {
		$this->manifest->setDocroot($docroot);
	}
	
	/**
	 * Set health check url
	 * @param string $healthcheck
	 */
	public function setHealthcheck($healthcheck) {
		$this->manifest->setHealthcheck($healthcheck);
	}
}