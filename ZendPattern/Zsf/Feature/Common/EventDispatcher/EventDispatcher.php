<?php
namespace ZendPattern\Zsf\Feature\Common\EventDispatcher;

use ZendPattern\Zsf\Feature\FeatureAbstract;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\Event;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManager;
/**
 * Implement a EventManager 
 * 
 * @author sophpie
 *
 */
class EventDispatcher extends FeatureAbstract
{
	/**
	 * Event manager
	 * 
	 * @var EventManagerInterface
	 */
	protected $eventManager;
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->setCanGenrateFeatureCallEvents(false);
	}

	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Feature\FeatureAbstract::__invoke()
	 */
	public function __invoke($args)
	{
		if ( ! $args) return $this;
		if ($args[0] instanceof EventManagerInterface) $this->setEventManager($args[0]);
		return $this;
	}
	
	/**
	 * @return the $eventManager
	 */
	protected function getEventManager() {
		if ( ! $this->eventManager) $this->setEventManager(new EventManager());
		return $this->eventManager;
	}

	/**
	 * @param \Zend\EventManager\EventManagerInterface $eventManager
	 */
	protected function setEventManager($eventManager) {
		$this->eventManager = $eventManager;
		$this->eventManager->setEventClass('ZendPattern\Zsf\Feature\Common\EventDispatcher\ZendServerEvent');
	}
	
	/**
	 * Trigger event
	 * 
	 * @param Event $event
	 * @param string $target
	 * @param unknown $argv
	 * @param string $callback
	 */
	public function trigger($event)
	{
		if ($event instanceof ZendServerEvent) $event->setServer($this->server);
		return $this->getEventManager()->trigger($event);
	}
	
	/**
	 * Attach a listener to an event
	 *
	 * @param  string $event
	 * @param  callable $callback
	 * @param  int $priority Priority at which to register listener
	 * @return CallbackHandler
	 */
	public function attach($event, $callback = null, $priority = 1)
	{
		return $this->getEventManager()->attach($event, $callback, $priority);
	}
	
	/**
	 * Detach an event listener
	 *
	 * @param  CallbackHandler|ListenerAggregateInterface $listener
	 * @return bool
	*/
	public function detach($listener)
	{
		return $this->getEventManager()->detach($listener);
	}
	
	/**
	 * Attach a listener aggregate
	 *
	 * @param  ListenerAggregateInterface $aggregate
	 * @param  int $priority If provided, a suggested priority for the aggregate to use
	 * @return mixed return value of {@link ListenerAggregateInterface::attach()}
	 */
	public function attachAggregate(ListenerAggregateInterface $aggregate, $priority = 1)
	{
		return $this->getEventManager()->attachAggregate($aggregate, $priority);
	}
	
	/**
	 * Detach a listener aggregate
	 *
	 * @param  ListenerAggregateInterface $aggregate
	 * @return mixed return value of {@link ListenerAggregateInterface::detach()}
	*/
	public function detachAggregate(ListenerAggregateInterface $aggregate)
	{
		return $this->getEventManager()->detachAggregate($aggregate);
	}
}