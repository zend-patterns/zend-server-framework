<?php
namespace ZendPattern\Zsf\Api\XmlHydrator;

use ZendPattern\Zsf\Api\XmlHydrator\XmlHydratorInterface;

class DirectiveHydrator extends XmlHydratorAbstract
{
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Api\XmlHydrator\XmlHydratorInterface::hydrate()
	 */
	public function hydrate($directive,\SimpleXMLElement $xmlData)
	{
		return $this->defaultHydratation($directive, $xmlData);
	}
}
