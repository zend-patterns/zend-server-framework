<?php
namespace ZendPattern\Zsf\Package;

class Manifest
{
	/**
	 * Application mame
	 * @var string
	 */
	private $name;
	
	/**
	 * Application summary
	 * @var string
	 */
	private $summary = '';
	
	/**
	 * Application description
	 * @var string
	 */
	private $description = '';
	
	/**
	 * Path to application icone
	 * @var string
	 */
	private $icon = '';
	
	/**
	 * Path to licence text file
	 * @var string
	 */
	private $eula = '';
	
	/**
	 * Package version
	 * @var Version
	 */
	private $version;
	
	/**
	 * Name of directory, within zpk archive, in wich application source will be copy
	 * @var string
	 */
	private $appdir = 'src';
	
	/**
	 * Docroot relative to archive root (strange ?)
	 * 
	 * if 'public' is your docroot and appdir is 'data', then set docroot as data/public.
	 * @var string
	 */
	private $docroot = '';
	
	/**
	 * Url use to check if applictaion is alive
	 * @var string
	 */
	private $healthcheck = '';
	
	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return the $summary
	 */
	public function getSummary() {
		return $this->summary;
	}

	/**
	 * @return the $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @return the $icon
	 */
	public function getIcon() {
		return $this->icon;
	}

	/**
	 * @return the $eula
	 */
	public function getEula() {
		return $this->eula;
	}

	/**
	 * @return the $version
	 */
	public function getVersion() {
		return $this->version;
	}

	/**
	 * @return the $appdir
	 */
	public function getAppdir() {
		return $this->appdir;
	}

	/**
	 * @return the $docroot
	 */
	public function getDocroot() {
		return $this->docroot;
	}

	/**
	 * @return the $healthcheck
	 */
	public function getHealthcheck() {
		return $this->healthcheck;
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @param string $summary
	 */
	public function setSummary($summary) {
		$this->summary = $summary;
	}

	/**
	 * @param string $description
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * @param string $icon
	 */
	public function setIcon($icon) {
		$this->icon = $icon;
	}

	/**
	 * @param string $eula
	 */
	public function setEula($eula) {
		$this->eula = $eula;
	}

	/**
	 * @param \ZendPattern\Zsf\Package\Version $version
	 */
	public function setVersion($version) {
		$this->version = $version;
	}

	/**
	 * @param string $appdir
	 */
	public function setAppdir($appdir) {
		$this->appdir = $appdir;
	}

	/**
	 * @param string $docroot
	 */
	public function setDocroot($docroot) {
		$this->docroot = $docroot;
	}

	/**
	 * @param string $healthcheck
	 */
	public function setHealthcheck($healthcheck) {
		$this->healthcheck = $healthcheck;
	}
}
