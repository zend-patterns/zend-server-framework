<?php
namespace ZendPattern\Zsf\Api\XmlHydrator;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
/**
 * Abstract factory to build XmlHydrator
 * @author sophpie
 *
 */
class CollectionHydratorAbstractFactory implements AbstractFactoryInterface
{
	/**
	 * Markup name
	 * @var string
	 */
	private $markupName;
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\AbstractFactoryInterface::canCreateServiceWithName()
	 */
	public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
	{
		if ( ! substr($name, 0,10) == 'hydrator::') return false;
		$this->markupName = substr($name, 10);
		if ( ! array_key_exists($this->markupName,$serviceLocator->get('collectionMarkups'))) return false;
		return true;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\AbstractFactoryInterface::createServiceWithName()
	 */
	public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
	{
		$hydrator = new CollectionHydrator();
		$hydrator->setContentKey($this->markupName);
		$collectionConfig = $serviceLocator->get('collectionMarkups');
		$hydrator->setContentKey($collectionConfig[$this->markupName]);
		$hydrator->setXmlMapper($serviceLocator);
		return $hydrator;
	}
}
