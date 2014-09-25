<?php
namespace ZendPattern\Zsf\JobQueue\Feature;

use ZendPattern\Zsf\Feature\FeatureAbstract;
use ZendPattern\Zsf\Model\Job\Job;
class CreateJob extends FeatureAbstract
{
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Feature\FeatureAbstract::__invoke()
	 * @param Job $job 
	 * @param array $vars
	 */
	public function __invoke($args)
	{
		/**
		 * @var Job $job
		 */
		$job = $args[0];
		$vars = array();
		if (isset($args[1])) $vars = $args[1];
		$options = array(
			'name' => $job->getName(),
			'priority' => $job->getPriority(),
		);
		$url = $job->getScript();
		$jobInfo = $this->getServer()->apiCall('jobqueueAddJob',array(
			'url' => $url,
			'options' => $options,
		));
		return $jobInfo;
		
		/*
		"predecessor" - Integer predecessor job id
		"persistent" - Boolean (keep in history forever)
		"schedule_time" - Time when job should be executed
		"schedule" - CRON-like scheduling command
		"http_headers" - Array of additional HTTP headers
		"job_timeout" - The timeout for the job
		"queue_name" - The queue assigned to the job
		*/
	}
}