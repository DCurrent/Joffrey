<?php

	namespace dc\joffrey;

	require_once('config.php');
	
	interface iGuid
	{
		// Accessors.
		function get_guid_string();
		
		// Mutators.
		function set_guid_string($value);
		
		// Core.
		function generate_guid();
	}

	class Guid implements iGuid
	{
		private $guid_string;
		
		public function __construct(GuidConfig $config = NULL)
		{
			
		}
		
		// Accessors.
		public function get_guid_string()
		{
			return $this->guid_string;
		}
		
		// Mutators.
		public function set_guid_string($value)
		{
			$this->guid_string = $value;
		}
		
		// Core.		
		public function generate_guid()
		{
			$result = NULL;
			
			if (function_exists('com_create_guid'))
			{
				$result = com_create_guid();
			}
			else
			{
				mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
				$charid = strtoupper(md5(uniqid(rand(), true)));
				$hyphen = chr(45);// "-"
				
				$uuid = //chr(123)// "{"
					substr($charid, 0, 8).$hyphen
					.substr($charid, 8, 4).$hyphen
					.substr($charid,12, 4).$hyphen
					.substr($charid,16, 4).$hyphen
					.substr($charid,20,12);
					//.chr(125);// "}"
				
				$result = $uuid;
			}
			
			$this->guid_string = $result;
			
			return $result;
			
		}		
	}

?>