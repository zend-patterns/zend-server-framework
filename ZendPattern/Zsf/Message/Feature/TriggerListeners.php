<?php
namespace ZendPattern\Zsf\Message\Feature;

use ZendPattern\Zsf\Feature\FeatureAbstract;
/**
 * Trigger all listerns attached to the given message channel
 * @author sophpie
 *
 */
class TriggerListener extends FeatureAbstract
{
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Feature\FeatureAbstract::__invoke()
	 */
	public function __invoke($args)
	{
		$listeners = $this;
	}
}