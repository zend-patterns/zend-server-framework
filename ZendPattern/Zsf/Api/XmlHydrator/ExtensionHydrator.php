<?php
namespace ZendPattern\Zsf\Api\XmlHydrator;

use ZendPattern\Zsf\Api\XmlHydrator\XmlHydratorInterface;

class ExtensionHydrator extends XmlHydratorAbstract
{
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Api\XmlHydrator\XmlHydratorInterface::hydrate()
	 */
	public function hydrate($phpExtension,\SimpleXMLElement $xmlData)
	{
		return $this->defaultHydratation($phpExtension, $xmlData);
	}
}
