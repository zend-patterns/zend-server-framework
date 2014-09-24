<?php
namespace ZendPattern\Zsf\Feature\Common;

use ZendPattern\Zsf\Feature\FeatureAbstract;

class Status extends FeatureAbstract
{
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Feature\FeatureAbstract::__invoke()
	 */
	public function __invoke($args)
	{
		$notifications = $this->getServer()->apiCall('getNotifications');
		return $notifications;
	}
	
}