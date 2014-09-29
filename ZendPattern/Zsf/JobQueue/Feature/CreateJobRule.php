<?php
namespace ZendPattern\Zsf\JobQueue\Feature;

use ZendPattern\Zsf\Feature\FeatureAbstract;
use ZendPattern\Zsf\Model\Job\Job;
class CreateJobRule extends FeatureAbstract
{
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Feature\FeatureAbstract::__invoke()
	 * @param JobRule $rule 
	 */
	public function __invoke($args)
	{
		$rule = $args[0];
		
	}
}