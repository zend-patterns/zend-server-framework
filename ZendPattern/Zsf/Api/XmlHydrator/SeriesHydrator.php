<?php
namespace ZendPattern\Zsf\Api\XmlHydrator;

class SeriesHydrator extends XmlHydratorAbstract
{
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Api\XmlHydrator\XmlHydratorAbstract::hydrate()
	 */
	public function hydrate($object, \SimpleXMLElement $xmlData)
	{
		$object =  $this->defaultHydratation($object, $xmlData);
		foreach ($xmlData->data->children() as $i){
			
		}
	}
}