<?php
class controller{

	public function __construct(){
		global $config;
	}

	public function loadView($viewName, $viewData = array()){
		$data = $viewData;
		include 'views/'.$viewName.'.php';
	}

	public function loadTemplate($viewName, $viewData = array()){
		$data = $viewData;
		include 'template/template.php';
	}

}