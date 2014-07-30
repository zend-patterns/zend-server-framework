<?php
namespace ZendPattern\Zsf\Server;

use ZendPattern\Zsf\Feature\ZendServer6\AutoDiscover;
/**
 * Zend Server 6 minimal implementation
 * 
 * @author sophpie
 *
 */
class ZendServer6 extends ZendServer
{
	const EDITION_FREE = 'free';
	const EDITION_SMB = 'smb';
	const EDITION_PRO = 'pro';
	const EDITION_ENTERPRISE = 'ZendServerCluster';
	
	/**
	 * Constructor
	 * 
	 */
	public function __construct()
	{
		parent::__construct();
		$this->setVersion('6.0.0');
		$this->addFeature(new AutoDiscover());
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\ZSWebAPI2\Server\ServerAbstract::checkEditionValidity()
	 */
	protected function checkEditionValidity()
	{
		$available_editions = array(self::EDITION_FREE, self::EDITION_ENTERPRISE, self::EDITION_PRO, self::EDITION_SMB);
		return in_array($this->edition, $available_editions);
	}
}