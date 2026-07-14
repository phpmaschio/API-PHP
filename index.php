<?php
$debug = getenv('APP_DEBUG') === '1';
error_reporting(E_ALL);
ini_set('display_errors', $debug ? '1' : '0');
ini_set('log_errors', '1');

// sessao so e iniciada quando alguma feature realmente usar $_SESSION
session_set_cookie_params(array(
	'httponly' => true,
	'samesite' => 'Lax'
));

//carregar arquivo de conf
require 'config/config.php';
require 'config/database.php';
require 'util/functions.php';

spl_autoload_register(
	function($class){
		if(file_exists('controllers/'.$class.'.php')){
			require_once 'controllers/'.$class.'.php';

		}elseif(file_exists('models/'.$class.'.php')){
			require_once 'models/'.$class.'.php';
			
		}elseif(file_exists('core/'.$class.'.php')){
			require_once 'core/'.$class.'.php';
		}
	}
);

try{
	$core = new Core();
	$core->exec();
}catch(Throwable $e){
	error_log('Erro não tratado: '.$e->getMessage());
	http_response_code(500);
	header('Content-Type: application/json; charset=utf-8');
	echo json_encode(array('status' => false, 'titulo' => 'Erro interno do servidor'));
}
