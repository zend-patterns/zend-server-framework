<?php
namespace ZendPattern\Zsf\Configuration\PhpExtension\XmlHydrator;

use ZendPattern\Zsf\Api\XmlHydrator\XmlHydratorInterface;

class PhpExtensionXmlHydrator implements XmlHydratorInterface
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
		if ((string)$xmlData->loaded == 'yes') $phpExtension->setLoaded(true);
		if ((string)$xmlData->loaded == 'no') $phpExtension->setLoaded(false);
		if ((string)$xmlData->installed == 'yes') $phpExtension->setInstalled(true);
		if ((string)$xmlData->installed == 'no') $phpExtension->setInstalled(false);
		if ((string)$xmlData->builtIn == 'yes') $phpExtension->setBuildIn(true);
		if ((string)$xmlData->builtIn == 'no') $phpExtension->setBuildIn(false);
		//@todo : manage message list
		return $phpExtension;
	}
}
