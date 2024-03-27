<?php
class pokemonController extends controller{

	private $dados;

	public function __construct(){
		parent::__construct();
		$this->dados = array();
	}

	public function index(){
		output_header(false,'método de consulta inválido');		
	}

	public function lista(){
		//$api = new Api();

		$pokemon = new Pokemon();
		$retorno = $pokemon->getAll();

		if(count($retorno) == 0){
			output_header(false, 'Nenhum dado encontrado');
		}

		output_header(true,'Consulta Realizada',$retorno);
	}

	public function get(){
		//$api = new Api();

		if(isset($_GET['numero']) && !empty($_GET['numero'])){
			$numero = $_GET['numero'];
		}else{
			output_header(false,'parametros não enviados');
		}

		$pokemon = new Pokemon();
		$retorno = $pokemon->getNumero($numero);

		if(!isset($retorno['numero']) || empty($retorno['numero'])){
			output_header(false,'Nenhum registro encontrado para o parametro informado');
		}

		output_header(true,'Consulta Realizada', $retorno);
	}

	public function search(){
		//$api = new Api();

		$search = null;
		if(isset($_GET['search']) && !empty($_GET['search'])){
			$search = $_GET['search'];
		}

		$pokemon = new Pokemon();
		$dados = $pokemon->getAll();

		if(count($dados) == 0){
			output_header(false, 'Nenhum dado encontrado');
		}

		$retorno = array();
		if(!empty($search)){
			foreach($dados as $item){
				if(
					(strpos(strtolower($item['nome']),strtolower($search)) !== false)
					or (strpos(strtolower($item['tipo']),strtolower($search)) !== false)
					or (strpos(strtolower($item['tipo2']),strtolower($search)) !== false)
					){
					$retorno[] = $item;
				}
			}
		}else{
			$retorno = $dados;
		}

		if(count($retorno)==0){
			output_header(false, 'Nenhum dado encontrado para o termo pesquisado');
		}

		output_header(true,'Consulta realizada',$retorno);
	}

	public function tipo(){
		//$api = new Api();

		$pokemon = new Pokemon();
		$retorno = $pokemon->getTipo();

		if(count($retorno)==0){
			output_header(false, 'Nenhum tipo cadastrado');
		}

		output_header(true,'Consulta realizada',$retorno);	
	}

}