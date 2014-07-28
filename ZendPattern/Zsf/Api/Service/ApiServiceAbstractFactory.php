<?php
namespace ZendPattern\Zsf\Api\Service;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
/**
 * Abstract factory in charge of generation Api Service.
 * @author sophpie
 *
 */
class ApiServiceAbstractFactory implements AbstractFactoryInterface
{
	/**
	 * Api service class Name
	 * 
	 * @var string
	 */
	protected $className;
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\AbstractFactoryInterface::canCreateServiceWithName()
	 */
	public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
	{
		$this->className = 'ZendPattern\Zsf\Api\Service\ZendServer\\' . ucfirst($name);
		if (class_exists($this->className)) return true;
		return false;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\AbstractFactoryInterface::createServiceWithName()
	 */
	public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
	{
		$apiService = new $this->className();
		return $apiService;
	}
}