<?php
namespace ZendPattern\Zsf\Console\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use ZendPattern\Zsf\Package\Manifest;
use ZendPattern\Zsf\Package\ManifestXmlManager;
use ZendPattern\Zsf\Package\Properties;
use ZendPattern\Zsf\Package\Version;
use ZendPattern\Zsf\Package\Package;
use ZendPattern\Zsf\Package\FilePicker;

class ZpkController extends AbstractActionController
{
	/**
	 * Adding deployment support files within working dir
	 * Add deployment.xml and deployment.properties files.
	 */
    public function initAction()
    {
        $workingDirName = realPath($this->params('sourceDir',getcwd()));
        $isForced = false;
        if ($this->params('force',false)) $isForced = true;
        $packageName = $this->params('name');
        $packageRelease = $this->params('release');
        $manifestFileName = $workingDirName . '/' . ManifestXmlManager::FILE_NAME;
        $propertiesFileName = $workingDirName . '/' . Properties::DEFAULT_FILE_NAME;
        if ( ! file_exists($manifestFileName) || $isForced){
        	$manifest = new Manifest();
        	$manifest->setName($packageName);
        	$version = new Version();
        	$version->setRelease($packageRelease);
        	$manifest->setVersion($version);
        	$this->getManifestXmlManager()->toXml($manifest,$manifestFileName);
        }
        if ( ! file_exists($propertiesFileName) || $isForced){
        	$properties = new Properties();
        	foreach (scandir($workingDirName) as $item){
        		if ($item == '.' || $item == '..' ) continue;
        		if (substr($item, 0,1) == '.') continue;
        		if ($item == 'deployment.xml') continue;
        		if ($item == 'deployment.properties') continue;
        		if ($item == 'vendor') continue;
        		if ($item == 'zpk') continue;
        		$properties->addSource($item);
        	}
        	$properties->save($propertiesFileName);
        }
    }
    
    /**
     * Pack and zip the targeted directory
     */
    public function packAction()
    {
    	$workingDirName = realPath($this->params('sourceDir',getcwd()));
    	$destinationDir = realPath($this->params('destinationDir',$workingDirName));
    	$package = new Package($workingDirName);
    	$zpkDir = $destinationDir . '/zpk';
    	if (is_dir($zpkDir)) $this->removeDir($zpkDir);
    	if ( ! is_dir($zpkDir)) mkdir($zpkDir,0777,true);
    	$package->copyContentTo($zpkDir);
    	$package->zip($destinationDir);
    	$this->removeDir($zpkDir);
    }
    
    /**
     * Empty and remove a directory
     * @param string $dir
     * @return boolean
     */
    protected function removeDir($dir)
    {
    	if ( ! is_dir($dir)) return false;
    	foreach (scandir($dir) as $item){
    		if ($item == '.' || $item =='..') continue;
    		if (is_file($dir.'/'.$item)) unlink($dir.'/'.$item);
    		if (is_dir($dir.'/'.$item)) $this->removeDir($dir.'/'.$item);
    	}
    	rmdir($dir);
    }
    
    /**
     * Returns Manifest xml manager
     * @return ManifestXmlManager;
     */
    protected function getManifestXmlManager()
    {
    	return $this->serviceLocator->get(ManifestXmlManager::SERVICE_KEY);
    }
    
}
