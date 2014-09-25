<?php
namespace ZendPattern\Zsf\Message\Feature;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZendPattern\Zsf\Message\ZSMessageBroker;

class PublishFactory implements FactoryInterface
{
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\FactoryInterface::createService()
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$zsMessageBroker = $serviceLocator->get(ZSMessageBroker::SERVICE_KEY);
		$publishFeature = new Publish();
		$publishFeature->setZsMessageBroker($zsMessageBroker);
		return $publishFeature;
	}
}