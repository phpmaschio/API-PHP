<?php
class API{

	public function __construct(){
		global $config;

		if(empty($_SERVER['HTTP_AUTH'])){
			http_response_code(401);
			output_header(false,'Token não enviado',array('consulte o manual da api','manual disponivel em nosso site'));
		}

		if(!hash_equals($config['apitoken'], $_SERVER['HTTP_AUTH'])){
			http_response_code(401);
			output_header(false,'Token inválido',array('Token enviado não encontrado','consulte o manual da api','manual disponivel em nosso site'));
		}
	}

}