<?php
namespace ZendPattern\Zsf\Package;

/**
 * File picker to select files to include within package
 * @author sophpie
 *
 */
class FilePicker
{
	const DUMMY_FILE_NAME = '.dummyfile';
	/**
	 * Generate a liast of files and directories
	 * @param array $includes
	 * @param array $excludes
	 * @param array $result
	 * @param string $root
	 * @return array
	 */
	public function pickFiles($includes,$excludes,$result,$root = '')
	{
		if ($root != '') $root = rtrim($root,'/') . '/';
		foreach ($includes as $item){
			if (in_array($item, $excludes)) continue;
			if (is_file($root.$item) || basename($item) == static::DUMMY_FILE_NAME) {
				$result[] = $item;
			}
			if (is_dir($root . $item)) {
				$subIncludes = array();
				foreach (scandir($root.$item) as $subItem){
					if ($subItem == '.' || $subItem == '..') continue;
					$subIncludes[] = $item.'/'.$subItem;
				}
				if (count($subIncludes) == 0){
					$subIncludes[] = $item . '/' . static::DUMMY_FILE_NAME;
				}
				$result = $this->pickFiles($subIncludes, $excludes, $result, $root);
			}
		}
		return $result;
	}
}