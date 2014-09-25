<?php
namespace ZendPattern\Zsf\Api\XmlHydrator;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use ZendPattern\Zsf\Api\XmlMapper;
use Zend\ServiceManager\ServiceLocatorInterface;

abstract class XmlHydratorAbstract implements XmlHydratorInterface, ServiceLocatorAwareInterface
{
	/**
	 * Xml mapper
	 * @var XmlMapper
	 */
	private $xmlMapper;
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Api\XmlHydrator\XmlHydratorInterface::hydrate()
	 */
	abstract public function hydrate($object,\SimpleXMLElement $xmlData);
	
	/**
	 * Hydration process by default
	 * 
	 * @param mixed $object
	 * @param \SimpleXMLElement $xmlData
	 * @return mixed
	 */
	protected function defaultHydratation($object,\SimpleXMLElement $xmlData)
	{
		foreach ($xmlData->children() as $xmlValue)
		{
			$propertyName = $xmlValue->getName();
			$setter = 'set' . ucfirst($propertyName);
			if ( ! method_exists($object,$setter)) continue;
			$object->$setter((string)$xmlValue);
		}
		return $object;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
	 */
	public function setServiceLocator(ServiceLocatorInterface $xmlMapper)
	{
		$this->xmlMapper = $xmlMapper;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::getServiceLocator()
	 */
	public function getServiceLocator()
	{
		return $this->xmlMapper;
	}
	
	/**
	 * Retunrs Xml mapper
	 * @return \ZendPattern\Zsf\Api\XmlMapper
	 */
	public function getXmlMapper()
	{
		return $this->xmlMapper;
	}
}