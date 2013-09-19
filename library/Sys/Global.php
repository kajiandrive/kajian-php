<?php

class Sys_Global {

	public static function isNotEmptyArray($param){
		$result = false;
		if(is_array($param) && count($param) > 0){
			$result = true;
		}
		return $result;
	}
	
	/**
	 * Mengubah tanggal ke format y-m-d
	 * @param unknown_type $date tanggal
	 * @param unknown_type format tanggal awal(param tanggal yang di input). contoh 'd-m-Y' / 'Y-m-d'
	 * @return string
	 */
	 public static function convertDateToYMD($date = '', $format = '', $separator = '-')
	 {
	 	$result = '';
	 	if (!empty($date)) {
	 		$arr = explode($separator, $date);
	 		switch ($format) {
	 			case 'd-m-Y':
	 				$result = "{$arr[2]}-{$arr[1]}-{$arr[0]}";
	 				break;
	 			case 'm-d-y':
	 				$result = "{$arr[2]}-{$arr[0]}-{$arr[1]}";
	 				break;
	 		}
	 	}
	 	return $result;
	 }
	 
	 /**
	  * Mengubah tanggal ke format d-m-y
	  * @param unknown_type $date tanggal
	  * @param unknown_type format tanggal awal(param tanggal yang di input). contoh 'd-m-Y' / 'Y-m-d'
	  * @return string
	  */
	 public static function convertDateToDMY($date = '', $format = '', $separator = '-')
	 {
	 	$result = '';
	 	if (!empty($date)) {
	 		$arr = explode($separator, $date);
	 		switch ($format) {
	 			case 'Y-m-d':
	 				$result = "{$arr[0]}-{$arr[1]}-{$arr[2]}";
	 				break;
	 			case 'm-d-y':
	 				$result = "{$arr[1]}-{$arr[0]}-{$arr[2]}";
	 				break;
	 		}
	 	}
	 	return $result;
	 }
	
	 /**
	  * Untuk redirect ke action tertentu
	  * @param String $controllerActionName: contoh /home/controller
	  */
	 public static function redirect($controllerActionName){
	 	$redirector = Zend_Controller_Action_HelperBroker::getStaticHelper('Redirector');
	 	$redirector->gotoUrl($controllerActionName);
	 }
	
	 /**
	  * Untuk mengambil base url
	  * @param unknown_type $file
	  * @return string
	  */
	 public static function baseUrl($file = null){
	 	$baseUrl = new Zend_View_Helper_BaseUrl();
	 	if($file == null)
	 		return $baseUrl->baseUrl();
	 	else
	 		return $baseUrl->baseUrl($file);
	 }

	 public static function printDebug($var = null)
	 {
	 	//Zend_Debug::dump($var); die();
	 	if (is_array($var)) {
	 		echo "<pre>"; print_r($var); echo "</pre>"; die();
	 	} else {
	 		echo "<p>\n{$var}\n</p>"; die();
	 	}
	 }
	
	 public static function appendJs($fileName)
	 {
	 	$script = new Zend_View_Helper_HeadScript();
		$script->appendFile(self::baseUrl($fileName));
		//$script->appendFile(self::baseUrl($fileName));
	 }
	 
	 public static function appendCss($fileName)
	 {
	 	$link = new Zend_View_Helper_HeadLink();
	 	$link->appendStylesheet(self::baseUrl($fileName));
	 	//$link->appendStylesheet(self::baseUrl($fileName));
	 }
	 
	public static function spanMaxTitle($string, $max = false, $title = false)
	{
		$tString = '';
		$tTitle = '';
		if($max !== false && strlen($string) > $max){
			$tTitle = $string;
			$tString = substr($string, 0,$max);
		}else
			$tString = $string;
		if($title !== false)
			$tTitle = $title;
		return "<span title='{$tTitle}'>{$tString}</span>";
	}
	 
	public static function linkBase($link = false){
		$result = '../';
		return ($link !== false) ? $result.$link : $result;
	}
	
	public static function linkModule($link = false){
		$previous = self::linkBase();
		$module = Zend_Controller_Front::getInstance()->getRequest()->getParam('module');
		$result = $previous.$module.'/';
		return ($link !== false) ? $result.$link : $result;
	}
	
	public static function linkController($link = false){
		$previous = self::linkModule();
		$controller = Zend_Controller_Front::getInstance()->getRequest()->getParam('controller');
		$result = $previous.$controller.'/';
		return ($link !== false) ? $result.$link : $result;
	}
	
	public static function linkAction($link = false){
		$previous = self::linkController();
		$action = Zend_Controller_Front::getInstance()->getRequest()->getParam('action');
		$result = $previous.$action.'/';
		return ($link !== false) ? $result.$link : $result;
	}

	public static function favicon($img){
		$link = new Zend_View_Helper_HeadLink();
		$link->headLink(array('rel' => 'shortcut icon', 'type'=>'image/x-icon','href' => $img),'PREPEND');
	}
}
