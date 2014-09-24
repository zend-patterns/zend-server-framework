<?php
namespace ZendPattern\Zsf\Model\Configuration;

/**
 * Extension model
 * @author sophpie
 *
 */
class Extension
{
	const EXTENSION_TYPE_PHP = 'php';
	
	const EXTENSION_STATUS_OFF = 'off';
	const EXTENSION_STATUS_LOADED = 'loaded';
	
	/**
	 * Name
	 * @var string
	 */
	protected $name;
	
	/**
	 * Version
	 * @var string
	 */
	protected $version;
	
	/**
	 * Type
	 * @var string
	 */
	protected $type;
	
	/**
	 * Status
	 * @var string
	 */
	protected $status;
	
	/**
	 * Check if extension is loaded
	 * @var boolean
	 */
	protected $loaded;
	
	/**
	 * Check if extension is installed
	 * @var boolean
	 */
	protected $installed;
	
	/**
	 * Check if extensino is built-in
	 * @var boolean
	 */
	protected $builtIn;
	
	/**
	 * Check if extension is dummy
	 * @var boolean
	 */
	protected $dummy;
	
	/**
	 * Short description
	 * @var string
	 */
	protected $shortDescription;
	
	/**
	 * Long description
	 * @var string
	 */
	protected $longDescription;
	
	protected $messageList;
	
	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return the $version
	 */
	public function getVersion() {
		return $this->version;
	}

	/**
	 * @return the $type
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @return the $status
	 */
	public function getStatus() {
		return constant('self::EXTENSION_STATUS_' . strtoupper($this->status));
	}

	/**
	 * @return the $loaded
	 */
	public function getLoaded() {
		return $this->loaded;
	}

	/**
	 * @return the $installed
	 */
	public function isInstalled() {
		return $this->installed;
	}

	/**
	 * @return the $builtIn
	 */
	public function isBuiltIn() {
		return $this->builtIn;
	}

	/**
	 * @return the $dummy
	 */
	public function isDummy() {
		return $this->dummy;
	}

	/**
	 * @return the $shortDescription
	 */
	public function getShortDescription() {
		return $this->shortDescription;
	}

	/**
	 * @return the $longDescription
	 */
	public function getLongDescription() {
		return $this->longDescription;
	}

	/**
	 * @return the $messageList
	 */
	public function getMessageList() {
		return $this->messageList;
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @param string $version
	 */
	public function setVersion($version) {
		$this->version = $version;
	}

	/**
	 * @param string $type
	 */
	public function setType($type) {
		$this->type = $type;
	}

	/**
	 * @param \ZendPattern\Zsf\Configuration\PhpExtension\unknown $status
	 */
	public function setStatus($status) {
		$status = strtoupper($status);
		$this->status = constant('self::EXTENSION_STATUS_' . $status);
	}
	
	/**
	 * @param boolean $loaded
	 */
	public function setLoaded($loaded) {
		$this->loaded = $loaded;
	}

	/**
	 * @param boolean $installed
	 */
	public function setInstalled($installed) {
		$this->installed = $installed;
	}

	/**
	 * @param boolean $builtIn
	 */
	public function setBuiltIn($builtIn) {
		$this->builtIn = $builtIn;
	}

	/**
	 * @param boolean $dummy
	 */
	public function setDummy($dummy) {
		$this->dummy = $dummy;
	}

	/**
	 * @param string $shortDescription
	 */
	public function setShortDescription($shortDescription) {
		$this->shortDescription = $shortDescription;
	}

	/**
	 * @param string $longDescription
	 */
	public function setLongDescription($longDescription) {
		$this->longDescription = $longDescription;
	}

	/**
	 * @param field_type $messageList
	 */
	public function setMessageList($messageList) {
		$this->messageList = $messageList;
	}
}
