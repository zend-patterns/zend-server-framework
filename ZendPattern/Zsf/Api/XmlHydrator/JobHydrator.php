<?php
namespace ZendPattern\Zsf\Api\XmlHydrator;

/**
 * Job hydrator
 * @author sophpie
 *
 */
class JobHydrator extends XmlHydratorAbstract
{
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Api\XmlHydrator\XmlHydratorAbstract::hydrate()
	 */
	public function hydrate($object, \SimpleXMLElement $xmlData)
	{
		return $this->defaultHydratation($object, $xmlData);
	}
}