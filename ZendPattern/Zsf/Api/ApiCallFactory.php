<?php
namespace ZendPattern\Zsf\Api;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ApiCallFactory implements FactoryInterface
{	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\FactoryInterface::createService()
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$apiCall = new ApiCall();
		$apiCall->setServiceLocator($serviceLocator);
		return $apiCall;
	}
}