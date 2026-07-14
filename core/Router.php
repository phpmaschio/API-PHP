<?php
class Router{
	private $routes = array();

	//metodo para adicionar uma rota
	public function addRoute($route, $callback){
		$this->routes[$route] = $callback;
	}

	//metodo para lidar com a rota atual
	public function handleRequest($route){
		if(array_key_exists($route, $this->routes)){
			$callback = $this->routes[$route];
			if(is_callable($callback)){
				call_user_func($callback);
			}else{
				http_response_code(500);
				echo json_encode(array('status' => false, 'titulo' => 'Rota inválida'));
			}
		}else{
			http_response_code(404);
			if(array_key_exists('/404', $this->routes)){
				call_user_func($this->routes['/404']);
			}else{
				echo json_encode(array('status' => false, 'titulo' => 'Página não encontrada'));
			}
		}
	}
}