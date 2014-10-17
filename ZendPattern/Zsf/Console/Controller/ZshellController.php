<?php
namespace ZendPattern\Zsf\Console\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Console\Prompt\Confirm;
use Zend\Console\Prompt\Line;
use Zend\Console\Prompt\PromptInterface;
use ZendPattern\Zsf\Server\ZendServer;
use ZendPattern\Zsf\Server\Configurator;

class ZshellController extends AbstractActionController
{
	/**
	 * Zend Server
	 * @var ZendServer
	 */
	private $zendServer ;
	
	/**
	 * Enter interactive mode
	 */
	public function promptAction()
	{
		$this->connect();
		$command = '';
		while ($command != 'exit'){
			$command = Line::prompt('>');
		}
		echo 'Good Bye !!'  . "\n";
		
	}
	
	/**
	 * 
	 */
	protected function connect()
	{
		$name = $this->params('name');
		//@todo : what to do if we aleready have config for the named ZS ?
		$uriPath = $this->params('url','http://localhost:10081/');
		$apiPath = $this->params('apipath','ZendServer/Api');
		$configurator = new Configurator();
		$zs = $configurator->configure($this->getZendServer(), array(
			'name' => $name,
			'uriPath' => $uriPath,
			'apiPath' => $apiPath,
		));
		$zs->autoDiscover();
		$this->setZendServer($zs);
		//@todo : save this in a file in /home
	}
	
	/**
	 * @return the $zendServer
	 */
	protected function getZendServer() {
		if ( ! $this->zendServer) $this->zendServer = new ZendServer();
		return $this->zendServer;
	}

	/**
	 * @param \ZendPattern\Zsf\Server\ZendServer $zendServer
	 */
	protected function setZendServer($zendServer) {
		$this->zendServer = $zendServer;
	}

	
	
}