<?php

require_once 'Crud.class.php';

class DepartamentoProduto extends Crud{
	
	protected $table = 'departamentoprodutos';
	       
	private $dataCadastro;
	private $quantidade;
	private $idProduto;
	private $idDepartamento;
	        
	public function getDataCadastro() {
	    return $this->dataCadastro;
	}

	public function setDataCadastro($dataCadastro) {
		$this->dataCadastro = $dataCadastro;
	}
	
	public function getQuantidade() {
	    return $this->dataCadastro;
	}

	public function setQuantidade($quantidade) {
		$this->quantidade = $quantidade;
	}
	
	public function getIdProduto() {
	    return $this->idProduto;
	}

	public function setIdProduto($idProduto) {
		$this->idProduto = $idProduto;
	}
	
	public function getIdDepartamento() {
	    return $this->idDepartamento;
	}

	public function setIdDepartamento($idDepartamento) {
		$this->idDepartamento = $idDepartamento;
	}

	public function findAllEstoque()
	{
		$sql  = "SELECT p.id AS id, p.descricao AS descricao, p.marca AS marca, p.numeroPatrimonio AS numeroPatrimonio,
					c.id AS idCategoria, c.descricao AS categoria, dp.id AS idDepartamentoProduto,
					date_format(str_to_date(dp.dataCadastro, '%Y-%m-%d'), '%d/%m/%Y') AS dataCadastro,
			 		dp.quantidade AS quantidade, d.id AS idDepartamento, d.nome AS departamento, d.empresa AS empresa 
					FROM produto AS p
					INNER JOIN categoria AS c ON p.idCategoria = c.id
					INNER JOIN departamentoprodutos AS dp ON p.id = dp.idProduto	
					INNER JOIN departamento AS d ON dp.idDepartamento = d.id  
					WHERE p.desativado = 0";
		$stmt = DB::prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}
   
    public function insert(){
		$dataCadastrar = date("Y/m/d");
		$sql  = "INSERT INTO $this->table (dataCadastro, quantidade, idProduto, idDepartamento) 
		VALUES (:dataCadastro, :quantidade, :idProduto, :idDepartamento)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':dataCadastro', $dataCadastrar);
		$stmt->bindParam(':quantidade', $this->quantidade);
		$stmt->bindParam(':idProduto', $this->idProduto);
		$stmt->bindParam(':idDepartamento', $this->idDepartamento);
        return $stmt->execute(); 
	}

	public function update($id){

		$sql  = "UPDATE $this->table SET dataCadastro = date_format(str_to_date(:dataCadastro, '%d/%m/%Y'), '%Y-%m-%d') , quantidade = :quantidade,
		 idProduto = :idProduto, idDepartamento  = :idDepartamento WHERE id = :id";
		$stmt = DB::prepare($sql);

		$stmt->bindParam(':dataCadastro', $this->dataCadastro);
		$stmt->bindParam(':quantidade', $this->quantidade);
		$stmt->bindParam(':idProduto', $this->idProduto);
		$stmt->bindParam(':idDepartamento', $this->idDepartamento);
        $stmt->bindParam(':id', $id);
		return $stmt->execute();
	}
	
}