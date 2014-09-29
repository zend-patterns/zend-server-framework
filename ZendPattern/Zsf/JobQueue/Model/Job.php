<?php
namespace ZendPattern\Zsf\JobQueue\Model;

use Zend\Stdlib\JsonSerializable;

class Job implements JsonSerializable
{
	
	private $id;
	
	private $type;
	
	private $nodeId;
	
	private $queueName;
	
	private $status;
	
	private $priority;
	
	private $persistent;
	
	private $script;
	
	private $name;
	
	private $creationTime;
	
	private $endTime;
	
	private $schedule;
	
	private $scheduleTime;
	
	private $scheduleId;
	
	private $applicationId;
	
	private $application;
	
	/**
	 * 
	 * @return multitype:field_type
	 */
	public function jsonSerialize()
	{
		return array(
			'id' => $this->id,
			'script' => $this->script,
		);
	}
	
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
	 * @return the $nodeId
	 */
	public function getNodeId() {
		return $this->nodeId;
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
	 * @return the $creationTime
	 */
	public function getCreationTime() {
		return $this->creationTime;
	}

	/**
	 * @return the $endTime
	 */
	public function getEndTime() {
		return $this->endTime;
	}

	/**
	 * @return the $schedule
	 */
	public function getSchedule() {
		return $this->schedule;
	}

	/**
	 * @return the $scheduleTime
	 */
	public function getScheduleTime() {
		return $this->scheduleTime;
	}

	/**
	 * @return the $scheduleId
	 */
	public function getScheduleId() {
		return $this->scheduleId;
	}

	/**
	 * @return the $applicationId
	 */
	public function getApplicationId() {
		return $this->applicationId;
	}

	/**
	 * @return the $application
	 */
	public function getApplication() {
		return $this->application;
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
	 * @param field_type $nodeId
	 */
	public function setNodeId($nodeId) {
		$this->nodeId = $nodeId;
	}

	/**
	 * @param field_type $queueName
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
	 * @param field_type $creationTime
	 */
	public function setCreationTime($creationTime) {
		$this->creationTime = $creationTime;
	}

	/**
	 * @param field_type $endTime
	 */
	public function setEndTime($endTime) {
		$this->endTime = $endTime;
	}

	/**
	 * @param field_type $schedule
	 */
	public function setSchedule($schedule) {
		$this->schedule = $schedule;
	}

	/**
	 * @param field_type $scheduleTime
	 */
	public function setScheduleTime($scheduleTime) {
		$this->scheduleTime = $scheduleTime;
	}

	/**
	 * @param field_type $scheduleId
	 */
	public function setScheduleId($scheduleId) {
		$this->scheduleId = $scheduleId;
	}

	/**
	 * @param field_type $applicationId
	 */
	public function setApplicationId($applicationId) {
		$this->applicationId = $applicationId;
	}

	/**
	 * @param field_type $application
	 */
	public function setApplication($application) {
		$this->application = $application;
	}

}
