<?php
namespace ZendPattern\Zsf\Message\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\Mvc\MvcEvent;
use ZendPattern\Zsf\Server\ZendServerManager;
use ZendPattern\Zsf\Message\ZSMessageBroker;
use ZendPattern\Zsf\Message\ZSMessage;

class MessagingController extends AbstractRestfulController
{
	const CONTROLLER_KEY = 'messaging';
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Mvc\Controller\AbstractRestfulController::getList()
	 */
	public function getList()
	{
		$message = new ZSMessage('garg');
		$message->getHeader()->addChannel('configuration');
		
		$testServer = $this->getZendServerManager()->get('distant');
		$broker = $this->getMessageBroker();
		$broker->addSubscriber($testServer,array('configuration'));
		
		$broker->dispacth($message);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Mvc\Controller\AbstractRestfulController::create()
	 */
	public function create($data)
	{
		$requestData = json_decode($this->getRequest()->getContent());
		$message = unserialize($requestData->message);
		
		$ZSMessageBroker = 
		
		var_dump($message);
		die('hop');
	}
	
	/**
	 * Returns message broker
	 * @return ZSMessageBroker
	 */
	protected function getMessageBroker()
	{
		return $this->serviceLocator->get(ZSMessageBroker::SERVICE_KEY);
	}
	
	/**
	 * Return Zend server manager
	 * @return ZendServerManager
	 */
	protected function getZendServerManager()
	{
		return $this->serviceLocator->get(ZendServerManager::SERVICE_KEY);
	}
}