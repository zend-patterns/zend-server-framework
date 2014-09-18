<?php
namespace ZendPattern\Zsf\Api;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
/**
 * Service factory for Xml to model mapper
 * @author sophpie
 *
 */
class XmlResponseModelMapperFactory implements FactoryInterface
{
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\FactoryInterface::createService()
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$config = include __DIR__ . '/config/xmlmapper.config.php';
		$mapper = new XmlResponseModelMapper();
		foreach ($config as $xmlMarkup => $array){
			$mapper->addMapp($xmlMarkup,$array['model'], $array['hydrator']);
		}
		return $mapper;
	}
}