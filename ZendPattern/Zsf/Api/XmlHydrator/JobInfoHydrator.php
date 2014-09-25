<?php
namespace ZendPattern\Zsf\Api\XmlHydrator;

use ZendPattern\Zsf\Model\Job\Job;
class JobInfoHydrator extends XmlHydratorAbstract
{
	/**
	 * (non-PHPdoc)
	 * @see \ZendPattern\Zsf\Api\XmlHydrator\XmlHydratorInterface::hydrate()
	 */
	public function hydrate($jobInfo,\SimpleXMLElement $xmlData)
	{
		$job = new Job;
		$jobHydrator = $this->getXmlMapper()->get('hydrator::job');
		$job= $jobHydrator->hydrate($job,$xmlData->jobInfo->job);
		$jobInfo->setJob($job);
		return $jobInfo;
	}
}