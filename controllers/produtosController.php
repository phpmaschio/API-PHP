<?php
class produtosController extends controller{

	private $dados;

	public function __construct(){
		parent::__construct();
		$this->dados = array();
	}

	public function index(){

		$api = new Api();

		$produto = new Produtos();
		$lista = $produto->getAll();

		output_header(true,'todos os produtos',$lista);

		//transformando em json
		//echo json_encode($lista);
		//$this->loadTemplate('produto', $this->dados);
	}

}
