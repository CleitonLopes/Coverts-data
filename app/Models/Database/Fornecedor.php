<?php

namespace APP\Models\Database;

use APP\Interfaces\ConexaoInterface;

class Fornecedor
{
	private $conn;

	public function __construct(ConexaoInterface $conexao)
	{
		$this->conn = $conexao->connect();
	}

	public function listar()
	{
		$resultado = new \stdClass();

		try
		{
			$stmt = $this->conn->prepare("SELECT * from clientes WHERE codigo like 'F%' ");
			$stmt->execute();

			$resultado->retorno = "OK";
			$resultado->data = $stmt->fetchAll(\PDO::FETCH_OBJ);

		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}

		return $resultado;
	}
}