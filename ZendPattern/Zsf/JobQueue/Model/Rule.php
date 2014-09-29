<?php
namespace ZendPattern\Zsf\JobQueue\Model;

class Rule
{
	private $id;
	
	private $type;
	
	private $queueName;
	
	private $status;
	
	private $priority = 'high';
	
	private $persistent;
	
	private $script;
	
	private $name;
	
	private $vars;
	
	private $http_headers;
	
	private $lastRun;
	
	private $nextRun;
	
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $type
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @return the $queueName
	 */
	public function getQueueName() {
		return $this->queueName;
	}

	/**
	 * @return the $status
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * @return the $priority
	 */
	public function getPriority() {
		return $this->priority;
	}

	/**
	 * @return the $persistent
	 */
	public function getPersistent() {
		return $this->persistent;
	}

	/**
	 * @return the $script
	 */
	public function getScript() {
		return $this->script;
	}

	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return the $vars
	 */
	public function getVars() {
		return $this->vars;
	}

	/**
	 * @return the $http_headers
	 */
	public function getHttp_headers() {
		return $this->http_headers;
	}

	/**
	 * @return the $lastRun
	 */
	public function getLastRun() {
		return $this->lastRun;
	}

	/**
	 * @return the $nextRun
	 */
	public function getNextRun() {
		return $this->nextRun;
	}

	/**
	 * @param field_type $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param field_type $type
	 */
	public function setType($type) {
		$this->type = $type;
	}

	/**
	 * @param field_type $queueNAme
	 */
	public function setQueueName($queueName) {
		$this->queueName = $queueName;
	}

	/**
	 * @param field_type $status
	 */
	public function setStatus($status) {
		$this->status = $status;
	}

	/**
	 * @param field_type $priority
	 */
	public function setPriority($priority) {
		$this->priority = $priority;
	}

	/**
	 * @param field_type $persistent
	 */
	public function setPersistent($persistent) {
		$this->persistent = $persistent;
	}

	/**
	 * @param field_type $script
	 */
	public function setScript($script) {
		$this->script = $script;
	}

	/**
	 * @param field_type $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @param field_type $vars
	 */
	public function setVars($vars) {
		$this->vars = $vars;
	}

	/**
	 * @param field_type $http_headers
	 */
	public function setHttp_headers($http_headers) {
		$this->http_headers = $http_headers;
	}

	/**
	 * @param field_type $lastRun
	 */
	public function setLastRun($lastRun) {
		$this->lastRun = $lastRun;
	}

	/**
	 * @param field_type $nextRun
	 */
	public function setNextRun($nextRun) {
		$this->nextRun = $nextRun;
	}

}

