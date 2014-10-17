<?php
namespace ZendPattern\Zsf\Statistics;

/**
 * Statistics series
 * @author sophpie
 *
 */
class Series
{
	/**
	 * Title
	 * @var string
	 */
	private $title;
	
	/**
	 * ??
	 * @var string
	 */
	private $ytitle;
	
	/**
	 * Value type
	 * @var string
	 */
	private $valueType;
	
	/**
	 * Serie name
	 * @var string
	 */
	private $name;
	
	/**
	 * Data
	 * @var array
	 */
	private $data = array();
	
	/**
	 * @return the $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @return the $ytitle
	 */
	public function getYtitle() {
		return $this->ytitle;
	}

	/**
	 * @return the $valueType
	 */
	public function getValueType() {
		return $this->valueType;
	}

	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return the $data
	 */
	public function getData() {
		return $this->data;
	}

	/**
	 * @param string $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * @param string $ytitle
	 */
	public function setYtitle($ytitle) {
		$this->ytitle = $ytitle;
	}

	/**
	 * @param string $valueType
	 */
	public function setValueType($valueType) {
		$this->valueType = $valueType;
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}
	
	/**
	 * Add Data
	 * @param integer $time
	 * @param string $value
	 */
	public function addData($time,$value)
	{
		$this->data[$time] = $value;
	}


}

/*<series>
<title>CPU Usage</title>
<yTitle>CPU usage</yTitle>
<valueType>%</valueType>
<name>CPU Usage</name>
<data>
<i ts=Ó1234Ó>12</i>
<i ts=Ó1234Ó>12</i>
<i ts=Ó1234Ó>12</i>
<i ts=Ó1234Ó>12</i>
<i ts=Ó1234Ó>12</i>
.
.
.
</data>
</series>*/