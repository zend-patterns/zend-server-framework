<?php
namespace ZendPattern\Zsf\Feature\ZF2;

use ZendPattern\Zsf\Feature\FeatureAbstract;
use Zend\Db\Adapter\Adapter;
use ZendPattern\Zsf\Exception\Exception;

/**
 * This feature give you access to Zend Server database 
 * 
 * @author sophpie
 *
 */
class Database extends FeatureAbstract
{
	/**
	 * Db Proxy
	 * 
	 * @var Adapter
	 */
	protected $dbAdapter;
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->setMinimalZSVersion('6.0.0');
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Feature\FeatureAbstract::__invoke()
	 */
	public function __invoke($args)
	{
		if (! $args) return $this;
		$config = $args[0];
		$this->checkDriverConfig($config);
		$this->createAdapter($config);
		return $this;
	}
	
	/**
	 * Check if given configuration is suitable to instantiate any adapter
	 * 
	 * @param array $config
	 */
	protected function checkDriverConfig($config);
	{
		if ( ! isset($config['driver'])) throw new Exception('No Database driver provided');
		$availableDrivers = array('Pdo_MySQL', 'Pdo_Sqlite');
		if ( ! in_array($config['driver'],$availableDrivers)) throw new Exception('Only Pdo_MySQl or Pdo_Sqlite allowed');
		if ( ! isset($config['database'])) throw new Exception('No database provided');
		if ($config['driver'] == 'Pdo_MySQL') {
			if ( ! isset($config['username'])) throw new Exception('No username provided');
			if ( ! isset($config['password'])) throw new Exception('No password provided');
		}
	}
	
	/**
	 * Create adapter from drvier array
	 * 
	 * @param array $config
	 */
	protected function createAdapter($config)
	{
		$adapter = new Adapter($config);
		$this->setDbAdapter($adapter);
	}
	
	/**
	 * @return the $dbAdapter
	 */
	public function getDbAdapter() {
		return $this->dbAdapter;
	}

	/**
	 * @param \Zend\Db\Adapter\Adapter $dbAdapter
	 */
	public function setDbAdapter(Adapter $dbAdapter) {
		$this->dbAdapter = $dbAdapter;
	}
}