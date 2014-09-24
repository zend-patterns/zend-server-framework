<?php
namespace ZendPattern\Zsf\Api;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZendPattern\Zsf\Api\XmlMapper;
use Zend\ServiceManager\Config;
/**
 * Xml Mapper factory
 * @author sophpie
 *
 */
class XmlMapperFactory implements FactoryInterface
{
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\FactoryInterface::createService()
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$config = $serviceLocator->get('config');
		$xmlMapperConfig = $config[XmlMapper::CONFIG_KEY];
		$xmlMapper = new XmlMapper(new Config($xmlMapperConfig));
		return $xmlMapper;
	}
}