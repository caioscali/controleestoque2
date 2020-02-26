<?php

require_once 'Crud.class.php';

class Produto extends Crud
{

	protected $table = 'produto';

	private $descricao;
	private $marca;
	private $numeroPatrimonio;
	private $idCategoria;

	public function getDescricao()
	{
		return $this->descricao;
	}

	public function setDescricao($descricao)
	{
		$this->descricao = $descricao;
	}

	public function getMarca()
	{
		return $this->marca;
	}

	public function setMarca($marca)
	{
		$this->marca = $marca;
	}

	public function getNumeroPatrimonio()
	{
		return $this->numeroPatrimonio;
	}

	public function setNumeroPatrimonio($numeroPatrimonio)
	{
		$this->numeroPatrimonio = $numeroPatrimonio;
	}

	public function getIdCategoria()
	{
		return $this->idCategoria;
	}

	public function setIdCategoria($idCategoria)
	{
		$this->idCategoria = $idCategoria;
	}

	public function insert()
	{
		$desativado = 0; // 0 para false e 1 para true
		$sql  = "INSERT INTO $this->table (descricao, marca, numeroPatrimonio, idCategoria, desativado) 
		VALUES (:descricao, :marca, :numeroPatrimonio, :idCategoria, :desativado)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':descricao', $this->descricao);
		$stmt->bindParam(':marca', $this->marca);
		$stmt->bindParam(':numeroPatrimonio', $this->numeroPatrimonio);
		$stmt->bindParam(':idCategoria', $this->idCategoria);
		$stmt->bindParam(':desativado', $desativado);
		$stmt->execute();
		$idCadastrado = DB::lastInsertId();
		return $idCadastrado;
	}

	public function update($id)
	{

		$sql  = "UPDATE $this->table SET  descricao = :descricao, marca = :marca, numeroPatrimonio = :numeroPatrimonio,
		idCategoria = :idCategoria WHERE id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':descricao', $this->descricao);
		$stmt->bindParam(':marca', $this->marca);
		$stmt->bindParam(':numeroPatrimonio', $this->numeroPatrimonio);
		$stmt->bindParam(':idCategoria', $this->idCategoria);
		$stmt->bindParam(':id', $id);
		return $stmt->execute();
	}
}
