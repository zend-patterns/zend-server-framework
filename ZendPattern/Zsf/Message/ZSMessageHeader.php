<?php
namespace ZendPattern\Zsf\Message;

class ZSMessageHeader
{
	/**
	 * Message priority
	 * @var integer
	 */
	private $priority = 0;
	
	/**
	 * Message channels
	 * @var array
	 */
	private $channels = array();
	
	/**
	 * Returns message priority
	 * @return integer
	 */
	public function getPriority()
	{
		return $this->priority;
	}
	
	/**
	 * Return message channels
	 * @return array
	 */
	public function getChannels()
	{
		return $this->channels;
	}
	
	/**
	 * Set priority
	 * @param integer $priority
	 */
	public function setPriority($priority)
	{
		$this->priority = $priority;
	}
	
	/**
	 * Add a channel
	 * @param unknown $channel
	 * @return boolean
	 */
	public function addChannel($channel)
	{
		if (in_array($channel, $this->channels)) return false;
		array_push($this->channels, $channel);
		return true;
	}
	
	/**
	 * Remove channel
	 * @param unknown $channel
	 * @return boolean
	 */
	public function removeChannel($channel)
	{
		if ( ! in_array($channel,$this->channels)) return false;
		$offset = array_keys($this->channels,$channel);
		unset($this->channels[$offset]);
		return true;
	}
}