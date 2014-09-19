<?php
namespace ZendPattern\Zsf\Api\XmlHydrator;

use ZendPattern\Zsf\Api\XmlHydrator\XmlHydratorInterface;

class ExtensionHydrator implements XmlHydratorInterface
{
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Api\XmlHydrator\XmlHydratorInterface::hydrate()
	 */
	public function hydrate($phpExtension,\SimpleXMLElement $xmlData)
	{
		$phpExtension->setName((string)$xmlData->name);
		$phpExtension->setVersion((string)$xmlData->version);
		$phpExtension->setType((string)$xmlData->type);//@todo : use string constant
		$phpExtension->setShortDescription((string)$xmlData->shortDescription);
		$phpExtension->setLongDescription((string)$xmlData->longDescription);
		$phpExtension->setStatus((string)$xmlData->status);
		if ((string)$xmlData->loaded == 'true') $phpExtension->setLoaded(true);
		if ((string)$xmlData->loaded == 'false') $phpExtension->setLoaded(false);
		if ((string)$xmlData->installed == 'true') $phpExtension->setInstalled(true);
		if ((string)$xmlData->installed == 'false') $phpExtension->setInstalled(false);
		if ((string)$xmlData->builtIn == 'true') $phpExtension->setBuiltIn(true);
		if ((string)$xmlData->builtIn == 'false') $phpExtension->setBuiltIn(false);
		//@todo : manage message list
		return $phpExtension;
	}
}
