<?php
namespace ZendPattern\Zsf\Api\XmlHydrator;

use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
/**
 * Inject XmlMapper within hydrator if hydrator implement ServiceLocatorAwareInerface
 * @author sophpie
 *
 */
class XmlMapperInjector implements InitializerInterface
{
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\InitializerInterface::initialize()
	 */
	public function initialize($instance, ServiceLocatorInterface $serviceLocator)
	{
		if ( ! $instance instanceof ServiceLocatorAwareInterface) return $instance;
		$instance->setServiceLocator($serviceLocator);
	}
	
}