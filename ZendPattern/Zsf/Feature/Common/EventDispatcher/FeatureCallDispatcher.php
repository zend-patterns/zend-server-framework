<?php
namespace ZendPattern\Zsf\Feature\Common\EventDispatcher;

use ZendPattern\Zsf\Feature\FeatureAbstract;
use Zend\EventManager\EventInterface;

/**
 * Dispatch event before and after each feature invokation.
 * 
 * Propagation of events will be stopped if a listener return false.
 * Will trigger PRE_ and POST_<CALLED FEATURE NAME>
 * @author sophpie
 *
 */
class FeatureCallDispatcher extends FeatureAbstract
{
	/**
	 * Event to dispatch
	 * 
	 * @var EventInterface
	 */
	protected $event;
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->setDependencies(array(
			'ZendPattern\Zsf\Feature\Common\EventDispatcher\EventDispatcher',
		));
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Feature\FeatureAbstract::__invoke()
	 */
	public function __invoke($args)
	{
		return $this;
	}
	
	/**
	 * Trigger a pre feature call event
	 * 
	 * @param string $method
	 * @param array $args
	 */
	public function triggerPreCall($method, $args)
	{
		$event = $this->getEvent();
		$event->setName('PRE_' . strtoupper($method));
		$event->setCalledfeature($method);
		$event->setFeatureCallArgs($args);
		return $this->server->eventDispatcher()->trigger($event,$this->server, array(), function ($v){return !$v;});
	}
	
	/**
	 * Trigger a post feature call event
	 *
	 * @param mixed $result : result of feature call
	 */
	public function triggerPostCall($callResult)
	{
		$event = $this->getEvent();
		$event->setName('POST_' . strtoupper($method));
		$event->setFeatureCallResult($callResult);
		return $this->server->eventDispatcher()->trigger($event,$this->server, array(), function ($v){return !$v;});
	}
	
	/**
	 * @return the $event
	 */
	public function getEvent() {
		if ( ! $this->event) $this->setEvent(new FeatureCallEvent());
		return $this->event;
	}

	/**
	 * @param \Zend\EventManager\EventInterface $event
	 */
	public function setEvent($event) {
		$this->event = $event;
	}
}