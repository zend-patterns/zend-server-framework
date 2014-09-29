<?php
namespace ZendPattern\Zsf\Api\XmlHydrator;

use ZendPattern\Zsf\Api\XmlHydrator\XmlHydratorInterface;

class RuleHydrator extends XmlHydratorAbstract
{
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Api\XmlHydrator\XmlHydratorInterface::hydrate()
	 */
	public function hydrate($rule,\SimpleXMLElement $xmlData)
	{
		return $this->defaultHydratation($rule, $xmlData);
	}
}
