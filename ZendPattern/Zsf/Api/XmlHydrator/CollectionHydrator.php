<?php
namespace ZendPattern\Zsf\Api\XmlHydrator;

use ZendPattern\Zsf\Api\XmlMapper;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
/**
 * Default collection XML hydrator
 * @author sophpie
 *
 */
class CollectionHydrator implements XmlHydratorInterface, ServiceLocatorAwareInterface
{
	/**
	 * Markup name of internal item collection
	 * 
	 * Example : "notifications" collection contains "notification" items. ContentKey = "notification"
	 * @var unknown
	 */
	private $contentKey;
	
	/**
	 * Reference to Xml Mapper
	 * @var XmlMapper
	 */
	private $xmlMapper;
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Api\XmlHydrator\XmlHydratorInterface::hydrate()
	 */
	public function hydrate($object,\SimpleXMLElement $xmlData)
	{
		foreach ($xmlData->children() as $name => $element)
		{
			if ($name != $this->getContentKey()) throw new \Exception('Given XML does not contain markup');
			$item = $this->getXmlMapper()->getModelResponse($element);
			$object->addElement($item);
		}
		return $object;
	}
	
	/**
	 * @return the $contentKey
	 */
	public function getContentKey() {
		return $this->contentKey;
	}

	/**
	 * @param \ZendPattern\Zsf\Api\XmlHydrator\unknown $contentKey
	 */
	public function setContentKey($contentKey) {
		$this->contentKey = $contentKey;
	}
	
	/**
	 * @return the $xmlMapper
	 */
	public function getXmlMapper() {
		return $this->xmlMapper;
	}

	/**
	 * @param \ZendPattern\Zsf\Api\XmlMapper $xmlMapper
	 */
	public function setXmlMapper(XmlMapper $xmlMapper) {
		$this->xmlMapper = $xmlMapper;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
	 */
	public function setServiceLocator(ServiceLocatorInterface $xmlMapper)
	{
		$this->setXmlMapper($xmlMapper);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::getServiceLocator()
	 */
	public function getServiceLocator()
	{
		return $this->xmlMapper;
	}
}