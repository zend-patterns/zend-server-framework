<?php
namespace ZendPattern\Zsf\Api\Listener;

use ZendPattern\Zsf\Api\ApiCallEvent;
use Zend\EventManager\ListenerAggregateInterface;
use ZendPattern\Zsf\Api\ApiCall;
use Zend\EventManager\EventManagerInterface;

/**
 * Listener in charge of complete request content 
 * 
 * Will deal with POST data depending is files have to be sent
 * within the request
 * @author sophpie
 *
 */
class RequestContentListener implements ListenerAggregateInterface
{
	/**
	 *
	 * @param EventManagerInterface $event
	 */
	public function attach(EventManagerInterface $events)
	{
		$events->attach(ApiCall::EVENT_SET_REQUEST,array($this,'prepareBody'), -5);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\EventManager\ListenerAggregateInterface::detach()
	 */
	public function detach(EventManagerInterface $events)
	{
		$events->detach($this);
		return $this;
	}
	
	/**
	 * Compute request body
	 * @param ApiServiceEvent $event
	 */
	public function prepareBody(ApiCallEvent $event)
	{
		$parameters = $event->getApiService()->getParameters();
		$request = $event->getRequest();
		if ( ! $request->isPost()) return;
		if(count($request->getFiles())) $body = $this->getMultipartBody($event);
		else $body = $this->getWwwFormUrlencodedBody($event);
		$request->setContent($body);
		$event->setRequest($request);
	}
	
	/**
	 * Compute multipart/form post data
	 * 
	 * @param ApiCallEvent $event
	 * @return string
	 */
	protected function getMultipartBody(ApiCallEvent $event)
	{
		$request = $event->getRequest();
		$body = '';
		$boundary = '---ZENDHTTPCLIENT-' . md5(microtime());
		$event->setMultiPartBoundary($boundary);
		$params = self::flattenParametersArray($request->getPost()->toArray());
		foreach ($params as $pp) {
			$body .= $this->encodeFormData($boundary, $pp[0], $pp[1]);
		}
		foreach ($request->getFiles()->toArray() as $file) {
			$fhead = array('Content-Type' => $file['ctype']);
			$body .= $this->encodeFormData($boundary, $file['formname'], $file['data'], $file['filename'], $fhead);
		}
		$body .= "--{$boundary}--\r\n";
		return $body;
	}
	
	/**
	 * Compute body for www-form-urlencode post data
	 * 
	 * @param ApiCallEvent $event
	 * @return string
	 */
	protected function getWwwFormUrlencodedBody(ApiCallEvent $event)
	{
		$body = '';
		$request = $event->getRequest();
		foreach ($request->getPost() as $name => $value) {
			$body .= '&' . urlencode($name) .'=' . urlencode($value);
		}
		$body = trim($body,'&');
		return $body;
	}
	
	/**
	 * Convert an array of parameters into a flat array of (key, value) pairs
	 *
	 * Will flatten a potentially multi-dimentional array of parameters (such
	 * as POST parameters) into a flat array of (key, value) paris. In case
	 * of multi-dimentional arrays, square brackets ([]) will be added to the
	 * key to indicate an array.
	 *
	 * @since 1.9
	 *
	 * @param array $parray
	 * @param string $prefix
	 * @return array
	 */
	protected function flattenParametersArray($parray, $prefix = null)
	{
		if (!is_array($parray)) {
			return $parray;
		}
		$parameters = array();
		foreach ($parray as $name => $value) {
			if ($prefix) {
				if (is_int($name)) {
					$key = $prefix . '[]';
				} else {
					$key = $prefix . "[$name]";
				}
			} else {
				$key = $name;
			}
			if (is_array($value)) {
				$parameters = array_merge($parameters, $this->flattenParametersArray($value, $key));
	
			} else {
				$parameters[] = array($key, $value);
			}
		}
		return $parameters;
	}
	
	/**
	 * Encode data to a multipart/form-data part suitable for a POST request.
	 *
	 * @param string $boundary
	 * @param string $name
	 * @param mixed $value
	 * @param string $filename
	 * @param array $headers Associative array of optional headers @example ("Content-Transfer-Encoding" => "binary")
	 * @return string
	 */
	public function encodeFormData($boundary, $name, $value, $filename = null, $headers = array())
	{
		$ret = "--{$boundary}\r\n" .
		'Content-Disposition: form-data; name="' . $name . '"';
		if ($filename) {
			$ret .= '; filename="' . $filename . '"';
		}
		$ret .= "\r\n";
		foreach ($headers as $hname => $hvalue) {
			$ret .= "{$hname}: {$hvalue}\r\n";
		}
		$ret .= "\r\n";
		$ret .= "{$value}\r\n";
		return $ret;
	}
}