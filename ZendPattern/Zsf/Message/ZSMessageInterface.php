<?php
namespace ZendPattern\Zsf\Message;

/**
 * Zend server messaging
 * @author sophpie
 *
 */
interface ZSMessageInterface
{
	/**
	 * Returns message header
	 * @returnZSMessageHeader
	 */
	public function getHeader();
	
	/**
	 * Returns message content
	 * @return mixzed
	 */
	public function getContent();
}