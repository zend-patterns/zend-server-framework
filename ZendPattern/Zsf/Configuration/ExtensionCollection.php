<?php
namespace ZendPattern\Zsf\Configuration;

class ExtensionCollection
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
	public function addExtension(Extension $extension)
	{
		array_push($this->extensions, $extension);
	}
}