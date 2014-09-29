<?php
namespace ZendPattern\Zsf\JobQueue\Model;

class JobInfo
{
	/**
	 * Job
	 * @var Job
	 */
	private $job;
	
	//private $jobDetails;
	
	/**
	 * @return the $job
	 */
	public function getJob() {
		return $this->job;
	}

	/**
	 * @return the $jobDetails
	 */
	/*public function getJobDetails() {
		return $this->jobDetails;
	}*/

	/**
	 * @param \ZendPattern\Zsf\Model\Job\Job $job
	 */
	public function setJob($job) {
		$this->job = $job;
	}

	/**
	 * @param field_type $jobDetails
	 */
	/*public function setJobDetails($jobDetails) {
		$this->jobDetails = $jobDetails;
	}*/

	
}