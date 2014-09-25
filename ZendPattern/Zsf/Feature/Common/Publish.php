<?php
namespace ZendPattern\Zsf\Feature\Common;

use ZendPattern\Zsf\Feature\FeatureAbstract;
use Zend\Crypt\PublicKey\Rsa\PublicKey;
use ZendPatter\Zsf\Message\ZendServerMessageBrocker;
/**
 * This feature allow the server to publish a message to a Zend Server message broker
 * @author sophpie
 *
 */
class Publish extends FeatureAbstract
{
	/**
	 * Message broker
	 * @var ZendServerMessageBrocker
	 */
	private $zsMessageBroker;
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Feature\FeatureAbstract::__invoke()
	 * @param $message ZendServerMessage
	 */
	public function __invoke($args)
	{
		$message = $args[0];
		$this->zsMessageBroker->publish($message);
	}
	
	/**
	 * @return the $zsMessageBroker
	 */
	public function getZsMessageBroker() {
		return $this->zsMessageBroker;
	}

	/**
	 * @param \ZendPatter\Zsf\Message\ZendServerMessageBrocker $zsMessageBroker
	 */
	public function setZsMessageBroker($zsMessageBroker) {
		$this->zsMessageBroker = $zsMessageBroker;
	}

}