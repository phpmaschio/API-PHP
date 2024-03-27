<?php
class Produtos extends model{

	public function getAll(){
		$array = array();

		$sql = "SELECT *
		          FROM tab_produtos";

		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0){
			$array = $sql->fetchAll(\PDO::FETCH_ASSOC);
		}	

		return $array;
	}

}