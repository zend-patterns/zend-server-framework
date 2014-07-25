<?php
namespace ZendPattern\Zsf\Api\Client;

use Zend\Http\Client;
use Zend\Http\Request;

abstract class ApiClientAbstract extends Client
{
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Http\Client::send()
	 */
	public function send(Request $request = null)
	{
		if ($request !== null) {
			$this->setRequest($request);
		}
		return parent::send($request);
	}
}