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
		$str  = rtrim($str,",\\\t");
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
}