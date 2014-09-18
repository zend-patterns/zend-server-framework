<?php
namespace ZendPattern\Zsf\Configuration\PhpExtension\XmlHydrator;

use ZendPattern\Zsf\Api\XmlHydrator\XmlHydratorInterface;
use ZendPattern\Zsf\Configuration\PhpExtension\PhpExtension;
use ZendPattern\Zsf\Configuration\PhpExtension\XmlHydrator\PhpExtensionXmlHydrator;

class PhpExtensionCollectionXmlHydrator implements XmlHydratorInterface
{
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Api\XmlHydrator\XmlHydratorInterface::hydrate()
	 */
	public function hydrate($phpExtensionCollection,\SimpleXMLElement $xmlData)
	{
		$extensionHydrator = new PhpExtensionXmlHydrator();
		foreach ($xmlData->children() as $extensionXml){
			$extension = new PhpExtension();
			$extension = $extensionHydrator->hydrate($extension, $extensionXml);
			$phpExtensionCollection->addExtension($extension);
		}
		return $phpExtensionCollection;
	}
}