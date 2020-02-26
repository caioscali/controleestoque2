<?php

require_once 'config/DB.class.php';

abstract class Crud extends DB{

	protected $table;
        

	abstract public function insert();
	abstract public function update($id);

	public function find($id){
		$sql  = "SELECT * FROM $this->table WHERE id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}
        
    public function findAll(){
		$sql  = "SELECT * FROM $this->table WHERE desativado = 0";
		$stmt = DB::prepare($sql);
		//$stmt->bindParam(':ordem', $ordem, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function desativar($id){
        $desativado = 1;// 0 para false e 1 para true
        $sql  = "UPDATE $this->table SET desativado = :desativado WHERE id = :id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':desativado', $desativado); 
        $stmt->bindParam(':id', $id); 
        return $stmt->execute();

    }

}