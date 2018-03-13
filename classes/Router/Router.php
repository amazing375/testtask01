<?php
session_start();
//class Router

class Router{
	
	

	//parse URL
	function parseURL() { 
		
		$url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		//explode URL by "/"
		$arURL = explode('/', trim($url_path, ' /'));
		return $arURL;
		
	}
	
		//first level of URL
	function getTitle() 
	{
		$arURL = $this->parseURL();
		switch ($arURL[0]) {
			case '':
				$string="Article... Lorem Ipsum";
				break;
		}
		return $string;
	}
	
	
	//first level of URL
	function firstLevelUrl() 
	{
		$arURL = $this->parseURL();
		switch ($arURL[0]) {
			case '':
				include($_SERVER['DOCUMENT_ROOT'].'/views/pages/index.php');
				break;
		}
	}

}

?>