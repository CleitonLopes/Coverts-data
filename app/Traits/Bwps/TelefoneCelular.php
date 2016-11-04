<?php

namespace APP\Traits\Bwps;

Trait TelefoneCelular
{

	public function insereTelefoneCelular($conn, $item, $recurso, $id)
	{
		$resultado = new \stdClass();

		try
		{
			$stmt = $conn->prepare('SELECT max(idtelefone) as maior FROM telefone');
			$stmt->execute();

			$idtelefone = 1;
			if($idtelefone = $stmt->fetch(\PDO::FETCH_OBJ))
			{
				$idtelefone = $idtelefone->maior + 1;
			}

			$stmt = $this->conn->prepare('INSERT INTO telefone(idtelefone, idparceiro, identificacao, ddd, telefone, ramal, contato, operadora, padrao, idempresa)
				VALUES(:idtelefone, :idparceiro, :identificacao, :ddd, :telefone, :ramal, :contato, :operadora, :padrao, :idempresa)');

			$stmt->bindParam(':idtelefone', 	$idtelefone, 					\PDO::PARAM_STR);
			$stmt->bindParam(':idparceiro', 	$id, 							\PDO::PARAM_STR);
			$stmt->bindParam(':identificacao', 	$item[$recurso]->identificacao, \PDO::PARAM_STR);
			$stmt->bindParam(':ddd', 			$item[$recurso]->ddd, 			\PDO::PARAM_STR);
			$stmt->bindParam(':telefone',		$item[$recurso]->telefone, 		\PDO::PARAM_STR);
			$stmt->bindParam(':ramal',			$item[$recurso]->ramal, 		\PDO::PARAM_STR);
			$stmt->bindParam(':contato',		$item[$recurso]->contato, 		\PDO::PARAM_STR);
			$stmt->bindParam(':operadora',		$item[$recurso]->operadora, 	\PDO::PARAM_STR);
			$stmt->bindParam(':padrao',			$item[$recurso]->padrao, 		\PDO::PARAM_STR);
			$stmt->bindParam(':idempresa',		$item[$recurso]->idempresa, 	\PDO::PARAM_STR);
			$stmt->execute();

			$resultado->retorno = "OK";


		}
		catch(\PDOException $e)
		{
			return $resultado->erro = $e->getMessage();
		}

		return $resultado;
	}

}