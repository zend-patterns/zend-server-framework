<?php
namespace ZendPattern\Zsf\Message\Feature;

use ZendPattern\Zsf\Feature\FeatureAbstract;
/**
 * This feature allow to attach listerners to message channels
 * @author sophpie
 *
 */
class Attach extends FeatureAbstract
{
	/**
	 * Listener
	 * array(
	 *     '<serverName>' => array(
	 *     		'<callable_1>,
	 *     	    '<callable_2>,
	 *          ....
	 *     )
	 * ),
	 * @var unknown
	 */
	private $listeners = array();
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Feature\FeatureAbstract::__invoke()
	 */
	public function __invoke($args)
	{
		$listeners = $args[0];
		$serverName = $this->getServer()->getName();
		$this->listeners[$serverName] = $listeners;
	}
}