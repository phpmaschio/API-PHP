<?php
class Pokemon extends model{
	
	public function getNumero($numero){
		$retorno = array();

		$sql = "SELECT *
		          FROM tab_pokemon
		         WHERE numero = :numero";
	
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':numero', $numero);
		$sql->execute();

		if($sql->rowCount() > 0){
			$retorno = $sql->fetch(\PDO::FETCH_ASSOC);
		}		         

		return $retorno;
	}

	public function getAll(){
		$retorno = array();

		$sql = "SELECT * 
		          FROM tab_pokemon
		         ORDER BY numero";
		
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0){
			$retorno = $sql->fetchAll(\PDO::FETCH_ASSOC);
		}		         

		return $retorno;
	}

	public function getTipo(){
		$retorno = array();

		$sql = "SELECT DISTINCT tipo as tipo FROM tab_pokemon
				 union
				SELECT DISTINCT tipo2 as tipo FROM tab_pokemon WHERE tipo2 IS NOT NULL
				order by 1";
		
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0){
			$retorno = $sql->fetchAll(\PDO::FETCH_ASSOC);
		}		         

		return $retorno;
	}

}