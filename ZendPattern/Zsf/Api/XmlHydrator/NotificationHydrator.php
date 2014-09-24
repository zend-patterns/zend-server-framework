<?php
namespace ZendPattern\Zsf\Api\XmlHydrator;

class NotificationHydrator implements XmlHydratorInterface
{
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Api\XmlHydrator\XmlHydratorInterface::hydrate()
	 */
	public function hydrate($notification,\SimpleXMLElement $xmlData)
	{
		$notification->setId((string)$xmlData->id);
		$notification->setSeverity((string)$xmlData->severity);
		$notification->setCreationTime((string)$xmlData->creationTime);
		$notification->setType((string)$xmlData->type);
		$notification->setName((string)$xmlData->name);
		$notification->setRepeats((int)$xmlData->repeats);
		$notification->setTitle((string)$xmlData->title);
		$notification->setDescription((string)$xmlData->description);
		$notification->setUrl((string)$xmlData->url);
		return $notification;
	}
}
