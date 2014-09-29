<?php
namespace ZendPattern\Zsf\Api\XmlHydrator;

use ZendPattern\Zsf\Api\XmlHydrator\XmlHydratorInterface;
use Zend\Validator\File\Extension;

class ComponentHydrator extends XmlHydratorAbstract
{
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Api\XmlHydrator\XmlHydratorInterface::hydrate()
	 */
	public function hydrate($component,\SimpleXMLElement $xmlData)
	{
		$extension = $this->getXmlMapper()->getModelResponse($xmlData->extension);
		$component->setExtension($extension);
		return $component;
	}
}
