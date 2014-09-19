<?php
namespace ZendPattern\Zsf\Feature;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\Config;

/**
 * Implement feature set as a service
 * @author sophpie
 *
 */
class FeatureSetFactory implements FactoryInterface
{
    /**
     * (non-PHPdoc)
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
    	$config = $serviceLocator->get('config');
    	$featureSetConfig = $config[FeatureSet::FEATURE_SET_GONFIG_KEY];
    	$featureSet = new FeatureSet(new Config($featureSetConfig));
    	return $featureSet;
    }
}