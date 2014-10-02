<?php
namespace ZendPattern\Zsf\Package;

/**
 * Package is a facade to handle manifest and properties file
 * @author sophpie
 * @todo : add librairie deployment support
 */
class Package
{
	/**
	 * Package source directory
	 * @var string
	 */
	private $sourceDir;
	
	/**
	 * Manifest xml manager
	 * @var ManifestXmlManager
	 */
	private $ManifestXmlManager;
	
	/**
	 * Deployment manifest
	 * @var Manifest
	 */
	private $manifest;
	
	/**
	 * Deployment properties
	 * @var Properties
	 */
	private $properties;
	
	/**
	 * Constructor
	 * @param string $sourceDir
	 */
	public function __construct($sourceDir)
	{
		$this->sourceDir = $sourceDir;
		$this->properties = new Properties();
		if (file_exists($this->sourceDir . '/' . Properties::DEFAULT_FILE_NAME)){
			$propertiesString = file_get_contents($this->sourceDir . '/' . Properties::DEFAULT_FILE_NAME);
			$this->properties->fromString($propertiesString);
		}
		$this->manifest = new Manifest();
		if (file_exists($this->sourceDir . '/' . ManifestXmlManager::FILE_NAME)){
			$this->manifest = $this->getManifestXmlManager()
				->fromXml($this->sourceDir . '/' . ManifestXmlManager::FILE_NAME, $this->manifest);
		}
	}
	
	/**
	 * Return package name
	 * @return string
	 */
	public function getName() {
		return $this->manifest->getName();
	}
	
	/**
	 * Returns package version
	 * @return Version
	 */
	public function getVersion() {
		return $this->manifest->getVersion();
	}
	
	/**
	 * Returns source file zpk directory
	 * @return string
	 */
	public function getAppdir() {
		return $this->manifest->getAppdir();
	}
	
	/**
	 * Returns deployment scripts zpk directory
	 * @return string
	 */
	public function getScriptsdir() {
		return $this->manifest->getScriptsdir();
	}
	
	/**
	 * Set package name
	 * @param string $name
	 */
	public function setName($name) {
		$this->manifest->setName($name);
	}
	
	/**
	 * Set Version
	 * @param \ZendPattern\Zsf\Package\Version $version
	 */
	public function setVersion($version) {
		$this->manifest->setVersion($version);
	}
	
	/**
	 * Set application source zpk directory
	 * @param string $appdir
	 */
	public function setAppdir($appdir) {
		$this->manifest->setAppdir($appdir);
	}
	
	/**
	 * @return the $sourceDir
	 */
	public function getSourceDir() {
		return $this->sourceDir;
	}

	/**
	 * @return the $ManifestXmlManager
	 */
	public function getManifestXmlManager() {
		if ( ! $this->ManifestXmlManager) $this->ManifestXmlManager = new ManifestXmlManager();
		return $this->ManifestXmlManager;
	}

	/**
	 * @return the $manifest
	 */
	public function getManifest() {
		return $this->manifest;
	}

	/**
	 * @return the $properties
	 */
	public function getProperties() {
		return $this->properties;
	}

	/**
	 * @param string $sourceDir
	 */
	public function setSourceDir($sourceDir) {
		$this->sourceDir = $sourceDir;
	}

	/**
	 * @param \ZendPattern\Zsf\Package\ManifestXmlManager $ManifestXmlManager
	 */
	public function setManifestXmlManager($ManifestXmlManager) {
		$this->ManifestXmlManager = $ManifestXmlManager;
	}

	/**
	 * @param \ZendPattern\Zsf\Package\Manifest $manifest
	 */
	public function setManifest($manifest) {
		$this->manifest = $manifest;
	}

	/**
	 * @param \ZendPattern\Zsf\Package\Properties $properties
	 */
	public function setProperties($properties) {
		$this->properties = $properties;
	}
	
	/**
	 * Copy package content to the given destination directory
	 * @param string $destDir
	 */
	public function copyContentTo($destinationDir)
	{
		$filePicker = new FilePicker();
		$properties = $this->getProperties();
		$sourceList = $filePicker->pickFiles($properties->getAppDirIncludes(),$properties->getAppDirExcludes(), array());
		$this->copyFileList($sourceList, $this->getSourceDir(), $destinationDir . '/' . $this->getAppdir());
		$scriptList = $filePicker->pickFiles($properties->getScriptsDirIncludes(),$properties->getScriptsDirExcludes(), array());
		$this->copyFileList($scriptList, $this->getSourceDir(), $destinationDir . '/' . $this->getScriptsdir());
		copy($this->getSourceDir() . '/deployment.xml',$destinationDir. '/deployment.xml');
	}
	
	/**
	 * Copy a list of files and directories from a given directory to another one
	 * @param array $list
	 * @param string $sourceRoot
	 * @param string $destinationDir
	 */
	protected function copyFileList($list,$sourceRoot,$destinationDir)
	{
		foreach ($list as $file){
			$source = $sourceRoot . '/' . $file;
			$dest =  $destinationDir . '/' . $file;
			$destDirectory = dirname($dest);
			if ( ! is_dir($destDirectory)) mkdir($destDirectory,0777,true);
			if (basename($source) != FilePicker::DUMMY_FILE_NAME) copy($source,$dest);
		}
	}
	
	/**
	 * Zip the package
	 * @param unknown $destinationDir
	 */
	public function zip($destinationDir, $extension = 'zpk')
	{
		$zpkArch = new \ZipArchive();
    	$zpkName = $this->getName() . '-' . $this->getVersion()->getRelease() .'.' . $extension;
    	$zpkArch->open($destinationDir . '/' . $zpkName, \ZipArchive::CREATE);
    	$this->addDirectoryToZip($destinationDir .'/zpk', $zpkArch);
    	$zpkArch->close();
	}
	
	/**
	 * Add a directory to a zip archive
	 * @param string $dir
	 * @param \ZipArchive $zipArchive
	 * @param string $localRoot
	 * @return ZipArchive
	 */
	protected function addDirectoryToZip($dir,\ZipArchive $zipArchive,$localRoot = '')
	{
		foreach (scandir($dir) as $item){
			if ($item == '.' || $item =='..') continue;
			if (is_file($dir . '/' . $item)) $zipArchive->addFile($dir . '/' . $item,$localRoot . '/' . $item);
			if (is_dir($dir . '/' . $item)) {
				$zipArchive->addEmptyDir($localRoot . '/' . $item);
				$this->addDirectoryToZip($dir . '/' . $item, $zipArchive,$localRoot . '/' . $item);
			}
		}
		return $zipArchive;
	}
}