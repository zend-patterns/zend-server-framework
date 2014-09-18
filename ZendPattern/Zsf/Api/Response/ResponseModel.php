<?php
namespace ZendPattern\Zsf\Api\Response;

class ResponseModel extends ResponseAbstract
{
	/**
	 * Fully hydrated model object
	 * @var mixed
	 */
	private $object;
	
	/**
	 * @return the $object
	 */
	public function getObject() {
		return $this->object;
	}

	/**
	 * @param \ZendPattern\Zsf\Api\Response\mixed $object
	 */
	public function setObject($object) {
		$this->object = $object;
	}

}