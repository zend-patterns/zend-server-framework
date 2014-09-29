<?php
namespace ZendPattern\Zsf\Message\Subscriber;

use Zend\ServiceManager\ServiceManager;

class SubscriberManager extends ServiceManager
{
	const SERVICE_KEY = 'Zsf\Message\SubscriberManager';
	const CONFIG_KEY = 'Zsf\Message\SubscriberManagerConfig';
}