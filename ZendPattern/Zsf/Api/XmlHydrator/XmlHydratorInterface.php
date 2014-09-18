<?php
namespace ZendPattern\Zsf\Api\XmlHydrator;

interface XmlHydratorInterface
{
	/**
	 * Hydrate given object with given xml
	 * 
	 * @param mixed $object
	 * @param \SimpleXMLElement $xmlData
	 * @return mixed
	 */
	public function hydrate($object,\SimpleXMLElement $xmlData);
	
}