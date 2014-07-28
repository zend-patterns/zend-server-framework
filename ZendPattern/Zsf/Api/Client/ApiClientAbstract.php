<?php
namespace ZendPattern\Zsf\Api\Client;

use ZendPattern\Zsf\Api\ApiRequest;
abstract class ApiClientAbstract
{
	/**
	 * Send Api request to a server service
	 * 
	 * @param $request ApiRequest
	 * @return ApiResponseAbstract
	 * 
	 */
	public function send(ApiRequest $request)
	{
		
	}
}