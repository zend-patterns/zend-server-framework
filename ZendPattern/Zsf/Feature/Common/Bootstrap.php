<?php
namespace ZendPattern\Zsf\Feature\Common;

use ZendPattern\Zsf\Api\XmlHydrator\KeyHydrator;
use ZendPattern\Zsf\Api\Key\Key;
use ZendPattern\Zsf\Api\XmlHydrator\BootstrapHydrator;
use ZendPattern\Zsf\Feature\FeatureAbstract;
/**
 * This feature ahas been design to bootstrap server
 * 
 * After a fresh intallation, Zend Server need to be bootstraped
 * @author sophpie
 *
 */
class Bootstrap extends FeatureAbstract
{
	/**
	 *  Constructor
	 */
	public function __construct()
	{
		$this->setDependencies(array(
				'ZendPattern\Zsf\Api\ApiCall'
		));
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Feature\FeatureAbstract::__invoke()
	 * @param $args array : 
	 * array(
	 * 	'production' => true / false
	 * 	'adminPassword' => '<password>',
	 * 	'applicationUrl' => '<url>', (not required)
	 * 	'adminEmail' => '<email>', (not required)
	 * 	'developerPassword' => '<password'>, (not required),
	 * 	'orderNumber' => '<orderId', (not required)
	 * 	'licenseKey' => '<license key>', (not required)
	 * 	'acceptEula' => true / false.
	 * )
	 */
	public function __invoke($args)
	{
		if ( ! isset($args[0]['acceptEula'])) $args[0]['acceptEula'] = 1;
		$server = $this->getServer();
		$bootstrapResponse = $server->apiCall('bootstrapSingleServer', $args[0]);
	}
}



