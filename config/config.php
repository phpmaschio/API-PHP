<?php
global $config;

// Credenciais e segredos vem de variaveis de ambiente. getenv() com
// fallback para valores de dev local, pra nao deixar segredo real no git.
$config = array();

$scheme  = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host    = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
define("BASE_URL", getenv('APP_BASE_URL') ?: $scheme.'://'.$host.'/');

$config['dbname']   = getenv('DB_NAME') ?: 'api';
$config['host']     = getenv('DB_HOST') ?: 'localhost';
$config['dbuser']   = getenv('DB_USER') ?: 'root';
$config['dbpass']   = getenv('DB_PASS') ?: '';
$config['apitoken'] = getenv('API_TOKEN') ?: '123456';
