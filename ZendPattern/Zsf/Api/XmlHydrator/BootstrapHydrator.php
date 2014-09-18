<?php
namespace ZendPattern\Zsf\Api\XmlHydrator;

use Zend\Db\Sql\Ddl\Column\Boolean;
use ZendPattern\Zsf\Api\Key\Key;
class BootstrapHydrator implements XmlHydratorInterface
{
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Api\XmlHydrator\XmlHydratorInterface::hydrate()
	 */
	public function hydrate($bootstrap, \SimpleXMLElement $xmlData)
	{
		$bootstrap->setSuccess((bool)$xmlData->success);
		$keyHydrator = new KeyHydrator();
		$key = new Key('admin', '');
		$key = $keyHydrator($key,$xmlData->apiKey);
		$bootstrap->setKey($key);
		return $bootStrap;
	}
}