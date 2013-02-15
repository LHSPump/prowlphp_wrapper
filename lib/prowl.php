<?php

namespace Prowl;

require __DIR__ . '/../vendor/src/Prowl/Connector.php';
require __DIR__ . '/../vendor/src/Prowl/Message.php';
require __DIR__ . '/../vendor/src/Prowl/Response.php';
require __DIR__ . '/../vendor/src/Prowl/Security/Secureable.php';
require __DIR__ . '/../vendor/src/Prowl/Security/PassthroughFilterImpl.php';

class Wrapper
{
	private $_api_keys;
	private $_application;
	
	public function __construct(array $api_keys, $application)
	{
		$this->_api_keys = $api_keys;
		$this->_application = $application;
	}
	
	public function push($event, $description, $url = null, $priority = 1)
	{
		$oProwl = new \Prowl\Connector();
		$oMsg 	= new \Prowl\Message();
		
		$oFilter = new \Prowl\Security\PassthroughFilterImpl();
		$oProwl->setFilter($oFilter);
		
		$oProwl->setIsPostRequest(true);
		$oMsg->setPriority($priority);
		
		foreach ($this->_api_keys as $key) {
			$oMsg->addApiKey($key);
		}

		$oMsg->setEvent($event);
		$oMsg->setDescription($description);
		$oMsg->setApplication($this->_application);
		
		if ($url) {
			$oMsg->setUrl($url);
		}
		
		return $oProwl->push($oMsg);
	}
}