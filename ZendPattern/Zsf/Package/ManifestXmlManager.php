<?php
namespace ZendPattern\Zsf\Package;

class ManifestXmlManager
{
	const FILE_NAME = 'deployment.xml';
	const SERVICE_KEY =' Zsf\ManifestXmlManager';
	const XML_HEADER = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><package xmlns="http://www.zend.com/server/deployment-descriptor/1.0" version="1.0"></package>';
	static $properties = array(
		'name','summary','description','appdir','icon','eula','docroot','healthcheck'
	);
	
	/**
	 * Render deploiment manifest as Xml file.
	 * @param Manifest $manifest
	 * @param string $fileName
	 */
	public function toXml(Manifest $manifest, $fileName)
	{
		$xml = new \SimpleXMLElement(static::XML_HEADER);
		foreach (static::$properties as $property){
			$getter = 'get' . ucfirst($property);
			$value = $manifest->$getter();
			$this->setXmlProperty($xml, $property, $value);
		}
		$version = $manifest->getVersion();
		if ($version){
			$xmlVersion = $xml->addChild('version');
			if ($version->getRelease())
				$this->setXmlProperty($xmlVersion, 'release', $version->getRelease());
			if ($version->getApi())
				$this->setXmlProperty($xmlVersion, 'api', $version->getApi());
		}
		return $xml->saveXML($fileName);
	}
	
	/**
	 * Set property value to an xml element
	 * @param \SimpleXMLElement $xml
	 * @param string $property
	 * @param string $value
	 */
	protected function setXmlProperty(\SimpleXMLElement $xml,$property,$value)
	{
		if ( ! $xml->$property) {
			$xml->addChild($property,$value);
		}
		else $xml->$property = $value;
	}
	
	/**
	 * Hydrate manifest from xml file
	 * @param string $xmlFile
	 * @param Manifest $manifest
	 * @return Manifest
	 */
	public function fromXml($xmlFile, Manifest $manifest)
	{
		$xml = simplexml_load_file($xmlFile);
		foreach (static::$properties as $property){
			if ($xml->$property) {
				$setter = 'set' . ucfirst($property);
				$manifest->$setter((string)$xml->$property);
			}
		}
		return $manifest;
	}
}