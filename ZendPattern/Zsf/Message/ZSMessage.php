<?php
namespace ZendPattern\Zsf\Message;

class ZSMessage implements ZSMessageInterface
{
	/**
	 * Message content
	 * @var string
	 */
	private $content;
	
	/**
	 * Message header
	 * @var ZSMessageHeader
	 */
	private $header;
	
	/**
	 * Constructeur
	 * @param string $content
	 */
	public function __construct($content)
	{
		$this->content = $content;
	}
	
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