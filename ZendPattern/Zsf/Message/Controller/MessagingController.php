<?php
namespace ZendPattern\Zsf\Message\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\Mvc\MvcEvent;
use ZendPattern\Zsf\Server\ZendServerManager;

class MessagingController extends AbstractRestfulController
{
	const CONTROLLER_KEY = 'messaging';
	
	public function getList()
	{
		$server = $this->serviceLocator->get(ZendServerManager::SERVICE_KEY)->get('localhost');
		$jobList = $server->apiCall('jobqueueJobsList');
		echo json_encode($jobList, JSON_PRETTY_PRINT);
		die();
	}
	
	/*public function onDispatch(MvcEvent $e)
	{
		die('arg');
	}*/
}