<?php
namespace ZendPattern\Zsf\Configuration\PhpExtension;

class PhpExtensionCollection
{
	/**
	 * Set of extensions
	 * @var array
	 */
	protected $extensions = array();
	
	/**
	 * Add an extension
	 * @param PhpExtension $extension
	 */
	public function addExtension(PhpExtension $extension)
	{
		array_push($this->extensions, $extension);
	}
}