<?php
namespace ZendPattern\Zsf\Model;

use Zend\Stdlib\JsonSerializable;
class Collection implements \Iterator, JsonSerializable
{
	/**
	 * Collection storage
	 * @var array
	 */
	private $storage = array();
	
	/**
	 * Iterator index
	 * @var int
	 */
	private $index = 0;
	
	/**
	 * 
	 * @param unknown $element
	 */
	public function addElement($element)
	{
		array_push($this->storage,$element);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Iterator::current()
	 */
	public function current()
	{
		return $this->storage[$this->index];
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Iterator::next()
	 */
	public function next()
	{
		$this->index++;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Iterator::key()
	 */
	public function key()
	{
		return $this->index;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Iterator::valid()
	 */
	public function valid()
	{
		if ($this->index < 0) return false;
		if ($this->index > count($this->storage)-1) return false;
		return true;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Iterator::rewind()
	 */
	public function rewind()
	{
		$this->index = 0;
	}
	
	public function jsonSerialize()
	{
		$jsonArray = array();
		foreach ($this->storage as $element){
			array_push($jsonArray,$element->jsonSerialize());
		}
		return $jsonArray;
	}
}