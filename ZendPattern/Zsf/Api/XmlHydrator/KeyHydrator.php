<?php
namespace ZendPattern\Zsf\Api\XmlHydrator;

use ZendPattern\Zsf\Api\Key\Key;
/**
 * Xml hydrator for apiKeys
 * 
 * xml data has to be what is in <apikey> markup
 * @author sophpie
 *
 */
class KeyHydrator implements XmlHydratorInterface
{
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Api\XmlHydrator\XmlHydratorInterface::hydrate()
	 */
	public function hydrate($object, \SimpleXMLElement $xmlData)
	{
		if ( ! $object instanceof Key) return false;
		$key->setId((string)$xmlData->id);
		$key->setUserName((string)$xmlData->username);
		$key->setName((string)$xmlData->name);
		$key->setHash((string)$xmlsData->hash);
		$key->setCreationTime((string)$xmlData->creationTime);
		return $key;
	}
}