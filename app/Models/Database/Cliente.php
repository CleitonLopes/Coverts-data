<?php

namespace APP\Models\Database;

use APP\Interfaces\ConexaoInterface;

class Cliente
{

	private $conn;

	public function __construct(ConexaoInterface $conexao)
	{
		$this->conn = $conexao->connect();
	}

	public function listarClientes()
	{
		$resultado = new \stdClass();

		try
		{
			$stmt = $this->conn->prepare("SELECT * from clientes WHERE codigo like 'C%' ");
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