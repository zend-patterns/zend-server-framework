<?php
namespace ZendPattern\Zsf\Console\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use ZendPattern\Zsf\Package\Manifest;
use ZendPattern\Zsf\Package\ManifestXmlManager;
use ZendPattern\Zsf\Package\Properties;

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
        
        $manifestFileName = $workingDirName . '/' . ManifestXmlManager::FILE_NAME;
        $propertiesFileName = $workingDirName . '/' . Properties::DEFAULT_FILE_NAME;
        if ( ! file_exists($manifestFileName)){
        	$manifest = new Manifest();
        	$manifest->setName($packageName);
        	$this->getManifestXmlManager()->toXml($manifest,$manifestFileName);
        }
        if ( ! file_exists($propertiesFileName)){
        	$properties = new Properties();
        	$properties->save($propertiesFileName);
        }
    }
    
    public function nameAction()
    {
    	$manifest = $this->getManifestXmlManager()->fromXml();
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
