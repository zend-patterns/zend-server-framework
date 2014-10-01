<?php
namespace ZendPattern\Zsf\Package;

/**
 * Manage deployment properties file
 * @author sophpie
 *
 */
class Properties
{
	const DEFAULT_FILE_NAME = 'deployment.properties';
	
	/**
	 * Files and directories included in source archive
	 * @var array
	 */
	private $appDirIncludes = array();
	
	/**
	 * Files and directories excludes in source archive
	 * @var array
	 */
	private $appDirExcludes = array();
	
	/**
	 * Files and directories includes in deployment scrips directory archive
	 * @var array
	 */
	private $scriptsDirIncludes = array();
	
	/**
	 * Files and directories not included in deployment scripts archive diretcory
	 * @var unknown
	 */
	private $scriptsDirExcludes = array();
	
	/**
	 * Returns properties as string
	 * 
	 * String is suitable to be save as fiel
	 * @return string
	 */
	public function toString()
	{
		$str = '';
		if (count($this->appDirIncludes) > 0) {
			$str .= 'appdir.includes = ' . $this->getPropertiesList($this->appDirIncludes);
		}
		if (count($this->scriptsDirIncludes) > 0) {
			$str .= 'scriptsdir.includes = ' . $this->getPropertiesList($this->scriptsDirIncludes);
		}
		if (count($this->appDirExcludes) > 0) {
			$str .= 'appdir.excludes = ' . $this->getPropertiesList($this->appDirExcludes);
		}
		if (count($this->scriptsDirExcludes) > 0) {
			$str .= 'scriptsdir.excludes = ' . $this->getPropertiesList($this->scriptsDirExcludes);
		}
		return $str;
	}
	
	/**
	 * Set properties form content of deployment properties file
	 * @param string $string
	 */
	public function fromString($string)
	{
		$string = preg_replace('@[\n\t\\\]@','',$string);
		$regExp = '(?:appdir.includes = (.*))';
		preg_match_all('@' . $regExp . '@', $string, $matches);
		$this->appDirIncludes = $this->setArrayFromString($matches[1][0]);
		$regExp = '(?:scriptsdir.includes = (.*))';
		preg_match_all('@' . $regExp . '@', $string, $matches);
		$this->scriptsDirIncludes = $this->setArrayFromString($matches[1][0]);
		$regExp = '(?:appdir.excludes = (.*))';
		preg_match_all('@' . $regExp . '@', $string, $matches);
		$this->appDirExcludes = $this->setArrayFromString($matches[1][0]);
		$regExp = '(?:scriptsdir.excludes = (.*))';
		preg_match_all('@' . $regExp . '@', $string, $matches);
		$this->scriptsDirExcludes = $this->setArrayFromString($matches[1][0]);
	}
	
	/**
	 * Get an array from propoerty list
	 * @param string $stringList
	 * @return array
	 */
	protected function setArrayFromString($stringList)
	{
		$array = explode(',',$stringList);
		if (count($array) == 1) return array();
		return $array;
	}
	
	/**
	 * Return given array as a string suitable for deployment properties files
	 * @param array $list
	 * @return string
	 */
	protected function getPropertiesList($list)
	{
		$str = '';
		foreach ($list as $inc){
			$str .= $inc . ",\\\n\t\t";
		}
		$str = substr($str,0,strlen($str)-5) . "\n";
		return $str;
	}
	
	/**
	 * Save properties file
	 * @param string $filename
	 * @return number
	 */
	public function save($filename)
	{
		$str = $this->toString();
		return file_put_contents($filename, $str);
	}
	
	/**
	 * Add a source file
	 * @param string $source
	 */
	public function addSource($source)
	{
		$this->appDirIncludes[] = $source;
	}
}