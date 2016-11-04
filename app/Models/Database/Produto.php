<?php

namespace APP\Models\Database;

use APP\Interfaces\ConexaoInterface;

class Produto
{
	private $conn;

	public function __construct(ConexaoInterface $conexao)
	{
		$this->conn = $conexao->connect();
	}

	public function listarLinha()
	{
		$resultado = new \stdClass();

		try
		{
			$stmt = $this->conn->prepare("SELECT * from linha");
			$stmt->execute();

			$resultado->retorno = "OK";
			$resultado->data = $stmt->fetchAll(\PDO::FETCH_OBJ);
		}
		catch(\PDOException $e)
		{
			return $e->getMessage();
		}

		return $resultado;
	}

	public function listarGrupo()
	{
		$resultado = new \stdClass();

		try
		{
			$stmt = $this->conn->prepare("SELECT * from grupo_produto");
			$stmt->execute();

			$resultado->retorno = "OK";
			$resultado->data = $stmt->fetchAll(\PDO::FETCH_OBJ);
		}
		catch(\PDOException $e)
		{
			return $e->getMessage();
		}

		return $resultado;
	}

	public function listarSubGrupo()
	{
		$resultado = new \stdClass();

		try
		{
			$stmt = $this->conn->prepare("SELECT * from sub_grupo_produto");
			$stmt->execute();

			$resultado->retorno = "OK";
			$resultado->data = $stmt->fetchAll(\PDO::FETCH_OBJ);
		}
		catch(\PDOException $e)
		{
			return $e->getMessage();
		}

		return $resultado;
	}

	public function listarProduto()
	{
		$resultado = new \stdClass();

		try
		{
			$stmt = $this->conn->prepare("SELECT * from produtos");
			$stmt->execute();

			$resultado->retorno = "OK";
			$resultado->data = $stmt->fetchAll(\PDO::FETCH_OBJ);
		}
		catch(\PDOException $e)
		{
			return $e->getMessage();
		}

		return $resultado;
	}





}