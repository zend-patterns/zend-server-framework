<?php
namespace ZendPattern\Zsf\Message;

class ZSMessage implements ZSMessageInterface
{
	/**
	 * Message content
	 * @var mixed
	 */
	private $content;
	
	/**
	 * Message header
	 * @var ZSMessageHeader
	 */
	private $header;
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Message\ZSMessageInterface::getHeader()
	 */
	public function getHeader()
	{
		return $this->header;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Message\ZSMessageInterface::getContent()
	 */
	public function getContent()
	{
		return $this->content;
	}
	
}