<?php
namespace ZendPattern\Zsf\Api\XmlHydrator;

use ZendPattern\Zsf\Api\XmlHydrator\XmlHydratorInterface;
use ZendPattern\Zsf\Configuration\Extension;
use ZendPattern\Zsf\Api\XmlHydrator\ExtensionHydrator;

class ExtensionCollectionHydrator implements XmlHydratorInterface
{
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Api\XmlHydrator\XmlHydratorInterface::hydrate()
	 */
	public function hydrate($extensionCollection,\SimpleXMLElement $xmlData)
	{
		$extensionHydrator = new ExtensionHydrator();
		foreach ($xmlData->children() as $extensionXml){
			$extension = new Extension();
			$extension = $extensionHydrator->hydrate($extension, $extensionXml);
			$extensionCollection->addExtension($extension);
		}
		return $extensionCollection;
	}
}