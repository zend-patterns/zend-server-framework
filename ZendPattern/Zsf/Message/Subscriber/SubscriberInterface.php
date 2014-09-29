<?php
namespace ZendPattern\Zsf\Message\Subscriber;

use ZendPattern\Zsf\Message\ZSMessageInterface;

interface SubscriberInterface
{
	public function execute(ZSMessageInterface $message);
}