<?php
namespace ZendPattern\Zsf\Feature\Common\EventDispatcher;

class FeatureCallEvent extends ZendServerEvent
{
	/**
	 * Name of the called feature
	 * 
	 * @var string
	 */
	protected $calledfeature;
	
	/**
	 * Arrgument passed to feature call
	 * 
	 * @var array
	 */
	protected $featureCallArgs;
	
	/**
	 * Result of feature call
	 * 
	 * @var mixed
	 */
	protected $featureCallResult;
	
	/**
	 * @return the $calledfeature
	 */
	public function getCalledfeature() {
		return $this->calledfeature;
	}

	/**
	 * @return the $featureCallArgs
	 */
	public function getFeatureCallArgs() {
		return $this->featureCallArgs;
	}

	/**
	 * @return the $featureCallResult
	 */
	public function getFeatureCallResult() {
		return $this->featureCallResult;
	}

	/**
	 * @param string $calledfeature
	 */
	public function setCalledfeature($calledfeature) {
		$this->calledfeature = $calledfeature;
	}

	/**
	 * @param multitype: $featureCallArgs
	 */
	public function setFeatureCallArgs($featureCallArgs) {
		$this->featureCallArgs = $featureCallArgs;
	}

	/**
	 * @param \ZendPattern\Zsf\Feature\Common\EventDispatcher\mixed $featureCallResult
	 */
	public function setFeatureCallResult($featureCallResult) {
		$this->featureCallResult = $featureCallResult;
	}

}