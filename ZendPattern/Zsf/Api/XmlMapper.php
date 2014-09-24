<?php
namespace ZendPattern\Zsf\Api;

use Zend\ServiceManager\ServiceManager;
use ZendPattern\Zsf\Api\Response\ResponseXml;
use ZendPattern\Zsf\Api\XmlHydrator\CollectionHydrator;
use ZendPattern\Zsf\Model\Collection;
/**
 * Service manager in charge of mapping Api Xml response in to model
 * @author sophpie
 *
 */
class XmlMapper extends ServiceManager
{
	const SERVICE_KEY = 'Zsf\XmlMapper';
	const CONFIG_KEY = 'Zsf\XmlMapper\Config';
	
	/**
	 * Return model from response xml
	 * @param ResponseXml $response
	 * @return mixed
	 */
	public function getModelResponse(\SimpleXMLElement $xmlData)
	{
		$markup = $xmlData->getName();
		$xmlHydrator = $this->getXmlHydrator($markup);
		if ($xmlHydrator instanceOf CollectionHydrator) $model = new Collection();
		else $model = $this->getModel($markup);
		$model = $xmlHydrator->hydrate($model,$xmlData);
		return $model;
	}
	
	/**
	 * Return hydrator to be used to hydrate given xml markup into an object
	 * @param string $markupName
	 * @return XmlHydrator
	 */
	public function getXmlHydrator($markupName)
	{
		$key = 'hydrator::' . $markupName;
		$hydrator = $this->get($key);
		return $hydrator;
	}
	
	/**
	 * Instantiate model
	 * 
	 * @param string $markupName
	 * @return mixed
	 */
	public function getModel($markupName)
	{
		$this->setShared('model::'.$markupName, false);
		return $this->get('model::'.$markupName);
	}
}