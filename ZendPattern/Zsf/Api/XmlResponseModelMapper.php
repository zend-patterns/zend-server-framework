<?php
namespace ZendPattern\Zsf\Api;
use ZendPattern\Zsf\Api\Response\ResponseXml;
/**
 * MApper to map xml markup from XmlResponse to a class model
 * @author sophpie
 *
 */
class XmlResponseModelMapper
{
	/**
	 * Xml markup to model mapping
	 * @var array
	 */
	private $map = array();
	
	/**
	 * @return the $map
	 */
	public function getMap() {
		return $this->map;
	}
	
	/**
	 * Adding a map entry
	 * 
	 * @param string $xmlMarkup XML markup name
	 * @param string $modelClassName  : Model class name
	 * @param string $hydratorClassName : Hydrator class name
	 */
	public function addMapp($xmlMarkup,$modelClassName, $hydratorClassName)
	{
		$xmlMarkup = strtolower(trim($xmlMarkup,'<>'));
		//if ( ! class_exists($modelClassName,true)) return false;
		//if ( ! class_exists($hydratorClassName,true)) return false;
		$this->map[$xmlMarkup] = array(
				'model' => $modelClassName,
				'hydrator' => $hydratorClassName,
		);
	}
	
	/**
	 * Get model hydrated from ResponseXml
	 * 
	 *  Or false if error.
	 * @param string $xmlMarkup
	 * @return boolean|mixed
	 */
	public function getModel(ResponseXml $response)
	{
		$xmlData = $response->getXmlContent()->responseData;
		$firstMarkup = current($xmlData->children());
		$markup = $firstMarkup->getName();
		$xmlMarkup = strtolower(trim($markup,'<>'));
		if ( ! array_key_exists($xmlMarkup, $this->map)) return false;
		$className = $this->map[$xmlMarkup]['model'];
		$object  = new $className();
		$hydratorClass = $this->map[$xmlMarkup]['hydrator'];
		$hydrator = new $hydratorClass();
		$object = $hydrator->hydrate($object,$firstMarkup);
		return $object;
	}
}