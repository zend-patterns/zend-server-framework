<?php
namespace ZendPattern\Zsf\Api\Response;

use Zend\Http\Response;

abstract class ResponseAbstract
{
	/**
	 * Raw Http reponse 
	 * 
	 * @var Response
	 */
	protected $innerResponse;
	
	/**
	 * Response factory from plain htt response
	 *
	 * @param Response $response
	 */
	public static function factory(Response $response)
	{
		$newResponse = new static();
		$newResponse->setInnerResponse($response);
		return $newResponse;
	}
	
	/**
	 * @return the $innerResponse
	 */
	public function getInnerResponse() {
		return $this->innerResponse;
	}

	/**
	 * @param \Zend\Http\Response $innerResponse
	 */
	public function setInnerResponse($innerResponse) {
		$this->innerResponse = $innerResponse;
	}

}