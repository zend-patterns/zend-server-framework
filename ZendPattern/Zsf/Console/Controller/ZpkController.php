<?php
namespace ZendPattern\Zsf\Console\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use ZendPattern\Zsf\Package\Manifest;
use ZendPattern\Zsf\Package\ManifestXmlManager;
use ZendPattern\Zsf\Package\Properties;
use ZendPattern\Zsf\Package\Version;

class ZpkController extends AbstractActionController
{
	/**
	 * Adding deployment support files within working dir
	 * Add deployment.xml and deployment.properties files.
	 */
    public function initAction()
    {
        $workingDirName = realPath($this->params('sourceDir',getcwd()));
        $packageName = $this->params('name');
        $packageRelease = $this->params('release');
        $manifestFileName = $workingDirName . '/' . ManifestXmlManager::FILE_NAME;
        $propertiesFileName = $workingDirName . '/' . Properties::DEFAULT_FILE_NAME;
        if ( ! file_exists($manifestFileName)){
        	$manifest = new Manifest();
        	$manifest->setName($packageName);
        	$version = new Version();
        	$version->setRelease($packageRelease);
        	$manifest->setVersion($version);
        	$this->getManifestXmlManager()->toXml($manifest,$manifestFileName);
        }
        if ( ! file_exists($propertiesFileName)){
        	$properties = new Properties();
        	foreach (scandir($workingDirName) as $item){
        		if ($item == '.' || $item == '..' ) continue;
        		if (substr($item, 0,1) == '.') continue;
        		if ($item == 'deployment.xml') continue;
        		if ($item == 'deployment.properties') continue;
        		$properties->addSource($item);
        	}
        	$properties->save($propertiesFileName);
        }
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
