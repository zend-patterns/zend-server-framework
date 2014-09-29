<?php
namespace ZendPattern\Zsf\Configuration\Model;

class Directive
{
	private $name;
	
	private $section;
	
	private $fileValue;
	
	private $defaultValue;
	
	private $previousValue;
	
	private $units;
	
	private $listValues;
	
	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return the $section
	 */
	public function getSection() {
		return $this->section;
	}

	/**
	 * @return the $fileValue
	 */
	public function getFileValue() {
		return $this->fileValue;
	}

	/**
	 * @return the $defaultValue
	 */
	public function getDefaultValue() {
		return $this->defaultValue;
	}

	/**
	 * @return the $previousValue
	 */
	public function getPreviousValue() {
		return $this->previousValue;
	}

	/**
	 * @return the $units
	 */
	public function getUnits() {
		return $this->units;
	}

	/**
	 * @param field_type $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @param field_type $section
	 */
	public function setSection($section) {
		$this->section = $section;
	}

	/**
	 * @param field_type $fileValue
	 */
	public function setFileValue($fileValue) {
		$this->fileValue = $fileValue;
	}

	/**
	 * @param field_type $defaultValue
	 */
	public function setDefaultValue($defaultValue) {
		$this->defaultValue = $defaultValue;
	}

	/**
	 * @param field_type $previousValue
	 */
	public function setPreviousValue($previousValue) {
		$this->previousValue = $previousValue;
	}

	/**
	 * @param field_type $units
	 */
	public function setUnits($units) {
		$this->units = $units;
	}

}