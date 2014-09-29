<?php
namespace ZendPattern\Zsf\Configuration\Feature;

use ZendPattern\Zsf\Feature\FeatureAbstract;

/**
 * This geature allow to modify, save and load configuration
 * @author sophpie
 *
 */
class Configuration extends FeatureAbstract
{
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Feature\FeatureAbstract::__invoke()
	 */
	public function __invoke($args)
	{
		return $this;
	}
	
	/**
	 * Returns an array containing extensions and if they are loaded or not
	 * array(
	 *     'extension' => array(
	 *         '<name>' => <true,false>
	 *     )
	 * );
	 * @return array
	 */
	protected function getExtensionsConfigArray()
	{
		$configArray = array();
		$extensions = $this->getServer()->apiCall('configurationExtensionsList');
		$configArray['extension'] = array();
		foreach ($extensions as $extension){
			if ($extension->isBuiltIn() ) continue;
			$configArray['extension'][$extension->getName()] =  $extension->getLoaded();
		}
		return $configArray;
	}
	
	/**
	 * Returns an array containing directives and their values
	 * array(
	 *     'directive' => array(
	 *         '<name>' => <value>
	 *     )
	 * );
	 * @return array
	 */
	protected function getDirectivesConfigArray()
	{
		$configArray = array();
		$directives = $this->getServer()->apiCall('configurationDirectivesList');
		$configArray['directive'] = array();
		foreach ($directives as $directive){
			$configArray['directive'][$directive->getName()] =  $directive->getFileValue();
		}
		return $configArray;
	}
	
	/**
	 * Returns an array containing job rules
	 * array(
	 *     'jobRule' => array(
	 *         '<name>' => <jobRule_object>
	 *     )
	 * );
	 * @return array
	 */
	public function getJobRulesConfigArray()
	{
		$configRules = array();
		$jobQueueRules = $this->getServer()->apiCall('jobqueueRulesList');
		$configRules['jobRule'] = array();
		foreach ($jobQueueRules as $rule){
			$configRules['jobRule'][$rule->getName()] = $rule;
		}
		var_dump($configRules);
		return $configRules;
	}
	
	/**
	 * Update server configuration from given array
	 * array(
	 *     'extension' => array(
	 *         '<extension_name> => <true,false>
	 *     ),
	 *     'directive' => array(
	 *     	   '<directive_name> => <value>
	 *     ),
	 * );
	 * @param array $config
	 */
	public function update($config)
	{
		$this->updateExentions($config['extension']);
		$this->updateDirectives($confif['directive']);
	}
	
	/**
	 * Update extensions
	 * Load or unload extension according to given array
	 * array(
	 *     '<extension_name> => <true,false>,
	 * );
	 * @param array $config
	 */
	public function updateExentions($config)
	{
		$extensionToEnable = array();
		$extensionToDisable = array();
		$currentExtensionsConfig = $this->getExtensionsConfigArray();
		foreach ($config as $name => $isLoaded){
			if ($isLoaded == $currentExtensionsConfig['extension'][$name]) continue;
			if ($isLoaded) $extensionToEnable[] = $name;
			else $extensionToDisable[] = $name;
		}
		if (count($extensionToDisable) > 0){
			$this->getServer()->apiCall('configurationExtensionsOff',array(
					'extensions' => $extensionToDisable
			));
		}
		if (count($extensionToEnable) > 0){
			$this->getServer()->apiCall('configurationExtensionsOn',array(
					'extensions' => $extensionToEnable
			));
		}
	}
	
	/**
	 * Update directives values
	 * Modifiy directive values according to given array
	 * array(
	 *     '<directive_name> => <value>,
	 * );
	 * @param array $config
	 */
	public function updateDirectives($config)
	{
		$newDirectiveValues = array();
		$currentDirectivesValues = $this->getDirectivesConfigArray();
		foreach ($config as $name => $newDirValue){
			if ($newDirValue == $currentDirectivesValues['directive']) continue;
			else $newDirectiveValues[$name] = $newDirValue;
		}
		if (count($newDirectiveValues) > 0) {
			$this->getServer()->apiCall('configurationStoreDirectives', array(
					'directives' => $newDirectiveValues,
			));
		}
	}
}