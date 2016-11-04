<?php

namespace APP\Traits\Bwps;


Trait Email
{
	public function insereEmail($conn, $item, $id)
	{

		$resultado = new \stdClass();

		try
		{
			$stmt = $this->conn->prepare('SELECT max(idemail) as maior FROM email');
			$stmt->execute();

			$idemail = 1;
			if($idemail = $stmt->fetch(\PDO::FETCH_OBJ))
			{
				$idemail = $idemail	->maior + 1;
			}

			$stmt = $this->conn->prepare('INSERT INTO email(idemail, idparceiro, identificacao, email, contato, idsetor, observacao, datacadastro, idempresa, idempresasetor)
													VALUES(:idemail, :idparceiro, :identificacao, :email, :contato, :idsetor, :observacao, :datacadastro, :idempresa, :idempresasetor)');

			$stmt->bindParam(':idemail', 		$idemail, 				\PDO::PARAM_INT);
			$stmt->bindParam(':idparceiro', 	$id, 					\PDO::PARAM_STR);
			$stmt->bindParam(':identificacao', 	$item->identificacao , 	\PDO::PARAM_STR);
			$stmt->bindParam(':email', 			$item->email, 			\PDO::PARAM_STR);
			$stmt->bindParam(':contato', 		$item->contato, 		\PDO::PARAM_STR);
			$stmt->bindParam(':idsetor', 		$item->idsetor, 		\PDO::PARAM_STR);
			$stmt->bindParam(':observacao', 	$item->observacao, 		\PDO::PARAM_STR);
			$stmt->bindParam(':datacadastro', 	$item->datacadastro, 	\PDO::PARAM_STR);
			$stmt->bindParam(':idempresa', 		$item->idempresa, 		\PDO::PARAM_STR);
			$stmt->bindParam(':idempresasetor', $item->idempresasetor, 	\PDO::PARAM_STR);
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