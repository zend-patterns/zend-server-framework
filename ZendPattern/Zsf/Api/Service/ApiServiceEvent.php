<?php
namespace ZendPattern\Zsf\Api\Service;

use Zend\EventManager\Event;
use ZendPattern\Zsf\Api\ApiRequest;
use ZendPattern\Zsf\Api\Response\ResponseAbstract;

class ApiServiceEvent extends Event
{
	/**
	 * Api service recursion
	 * 
	 * @var ServiceAbstract
	 */
	protected $service;
	
	/**
	 * API request
	 * 
	 * @var ApiRequest
	 */
	protected $request;
	
	/**
	 * Api response
	 * 
	 * @var ResponseAbstract
	 */
	protected $response;
	
	/**
	 * Boundary string used in multipart form-data encoded request
	 * 
	 * @var string
	 */
	protected $multiPartBoundary;
	
	/**
	 * @return the $service
	 */
	public function getService() {
		return $this->service;
	}

	/**
	 * @param \ZendPattern\Zsf\Api\Service\ServiceAbstract $service
	 */
	public function setService($service) {
		$this->service = $service;
	}
	
	/**
	 * @return the $request
	 */
	public function getRequest() {
		return $this->request;
	}

	/**
	 * @param \ZendPattern\Zsf\Api\ApiRequest $request
	 */
	public function setRequest($request) {
		$this->request = $request;
	}
	
	/**
	 * @return the $response
	 */
	public function getResponse() {
		return $this->response;
	}

	/**
	 * @param \ZendPattern\Zsf\Api\Response\ResponseAbstract $response
	 */
	public function setResponse($response) {
		$this->response = $response;
	}
	
	/**
	 * @return the $multiPartBoundary
	 */
	public function getMultiPartBoundary() {
		return $this->multiPartBoundary;
	}

	/**
	 * @param string $multiPartBoundary
	 */
	public function setMultiPartBoundary($multiPartBoundary) {
		$this->multiPartBoundary = $multiPartBoundary;
	}
}