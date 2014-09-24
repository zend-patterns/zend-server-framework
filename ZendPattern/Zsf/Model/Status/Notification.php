<?php
namespace ZendPattern\Zsf\Model\Status;

/**
 * Zend Server notification model
 * @author sophpie
 *
 */
class Notification
{
	const SEVERITY_WARNING = "Warning";
	/**
	 * Id
	 * @var integer
	 */
	protected $id;
	
	/**
	 * Severity
	 * @var string
	 */
	protected $severity;
	
	/**
	 * Creation time
	 * @var unknown
	 */
	protected $creationTime;
	
	/**
	 * Type
	 * @var integer
	 */
	protected $type;
	
	/**
	 * Name
	 * @var string
	 */
	protected $name;
	
	/**
	 * Repeats
	 * @var integer
	 */
	protected $repeats;
	
	/**
	 * Title
	 * @var string
	 */
	protected $title;
	
	/**
	 * Description
	 * @var string
	 */
	protected $description;
	
	/**
	 * Url
	 * @var string
	 */
	protected $url;
	
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $severity
	 */
	public function getSeverity() {
		return $this->severity;
	}

	/**
	 * @return the $creationTime
	 */
	public function getCreationTime() {
		return $this->creationTime;
	}

	/**
	 * @return the $type
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return the $repeats
	 */
	public function getRepeats() {
		return $this->repeats;
	}

	/**
	 * @return the $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @return the $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @return the $url
	 */
	public function getUrl() {
		return $this->url;
	}

	/**
	 * @param number $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param string $severity
	 */
	public function setSeverity($severity) {
		$this->severity = $severity;
	}

	/**
	 * @param \ZendPattern\Zsf\Status\unknown $creationTime
	 */
	public function setCreationTime($creationTime) {
		$this->creationTime = $creationTime;
	}

	/**
	 * @param number $type
	 */
	public function setType($type) {
		$this->type = $type;
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @param number $repeats
	 */
	public function setRepeats($repeats) {
		$this->repeats = $repeats;
	}

	/**
	 * @param string $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * @param string $description
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * @param string $url
	 */
	public function setUrl($url) {
		$this->url = $url;
	}

}