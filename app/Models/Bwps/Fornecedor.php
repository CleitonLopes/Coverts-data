<?php

namespace APP\Models\Bwps;

use APP\Interfaces\ConexaoInterface;
use APP\Traits\Bwps\Email;
use APP\Traits\Bwps\TelefoneCelular;

class Fornecedor
{
	use Email;
	use TelefoneCelular;

	private $conn;

	public function __construct(ConexaoInterface $conexao)
	{
		$this->conn = $conexao->connect();
	}


	/**
	* Busca maior id dta tabela fornecedor
	* @return max idfornecedor
	*/

	public function selecionaMaiorFornecedor()
	{
		try
		{
			$stmt = $this->conn->prepare('SELECT max(idfornecedor) as maior FROM fornecedor');
			$stmt->execute();

			$idfornecedor = 1;

			if($idfornecedor = $stmt->fetch(\PDO::FETCH_OBJ))
			{
				$idfornecedor = $idfornecedor->maior + 1;
			}
		}
		catch(Exception $e)
		{
			return  $e->getMessage();
		}

		return $idfornecedor;
	}


	/**
	* Insere dados nas tablelas Fornecedor, Telefone, Celular e Email caso existam
	* @param $data = Array - Dados
	* @param $increment = Boolen - Retorna true quando for auto-increment
	* OBS: Traits para fazer consultas e inserts nas tabelas, Email, Celular e Telefone
	*/

	public function create($data, $increment)
	{
		$resultado = new \stdClass();

		try
		{
			foreach($data as $item)
			{
				if($increment)
				{
					$idfornecedor = $this->selecionaMaiorFornecedor();
					$item['dados']->idfornecedor = $idfornecedor;
				}

				$stmt = $this->conn->prepare('INSERT INTO fornecedor(idfornecedor, ativo, fisicajuridica, cpfcnpj, ierg, razaonome, nomefantasia,
																	cep, logradouro, endereco, numero, bairro, complemento,	datacadastro, idmunicipio,
																	idplanoconta, idempresa, idusuario, idempresaplanoconta, idempresamunicipio, idempresausuario)
															VALUES(:idfornecedor, :ativo, :fisicajuridica, :cpfcnpj, :ierg, :razaonome, :nomefantasia, :cep,
																	:logradouro, :endereco, :numero, :bairro, :complemento, :datacadastro, :idmunicipio, :idplanoconta,
																	:idempresa, :idusuario, :idempresaplanoconta, :idempresamunicipio, :idempresausuario)');

				$stmt->bindParam(':idfornecedor',			$item['dados']->idfornecedor,		\PDO::PARAM_STR);
				$stmt->bindParam(':ativo',					$item['dados']->ativo,				\PDO::PARAM_STR);
				$stmt->bindParam(':fisicajuridica',			$item['dados']->fisicajuridica,		\PDO::PARAM_STR);
				$stmt->bindParam(':cpfcnpj',				$item['dados']->cpfcnpj,			\PDO::PARAM_STR);
				$stmt->bindParam(':ierg',					$item['dados']->ierg,				\PDO::PARAM_STR);
				$stmt->bindParam(':razaonome',				$item['dados']->razaonome,			\PDO::PARAM_STR);
				$stmt->bindParam(':nomefantasia',			$item['dados']->nomefantasia,		\PDO::PARAM_STR);
				$stmt->bindParam(':cep',					$item['dados']->ceṕ,				\PDO::PARAM_STR);
				$stmt->bindParam(':logradouro',				$item['dados']->logradouro,			\PDO::PARAM_STR);
				$stmt->bindParam(':endereco',				$item['dados']->endereco,			\PDO::PARAM_STR);
				$stmt->bindParam(':numero',					$item['dados']->numero,				\PDO::PARAM_STR);
				$stmt->bindParam(':bairro',					$item['dados']->bairro,				\PDO::PARAM_STR);
				$stmt->bindParam(':complemento',			$item['dados']->complemento,		\PDO::PARAM_STR);
				$stmt->bindParam(':datacadastro',			$item['dados']->datacadastro,		\PDO::PARAM_STR);
				$stmt->bindParam(':idmunicipio',			$item['dados']->idmunicipio,		\PDO::PARAM_STR);
				$stmt->bindParam(':idplanoconta',			$item['dados']->idplanoconta,		\PDO::PARAM_STR);
				$stmt->bindParam(':idempresa',				$item['dados']->idempresa,			\PDO::PARAM_STR);
				$stmt->bindParam(':idusuario',				$item['dados']->idusuario,			\PDO::PARAM_STR);
				$stmt->bindParam(':idempresaplanoconta',	$item['dados']->idempresaplanoconta,\PDO::PARAM_STR);
				$stmt->bindParam(':idempresamunicipio',		$item['dados']->idempresamunicipio,	\PDO::PARAM_STR);
				$stmt->bindParam(':idempresausuari', 		$item['dados']->idempresausuario, 	\PDO::PARAM_STR);
				$stmt->execute();

				/* Trait - Insere Telefone se houver */
				if(isset($item['telefone']))
				{
					$this->insereTelefoneCelular($this->conn, $item, $recurso = 'telefone', $idfornecedor);
				}

				/* Trait - Insere Celular se houver */
				if(isset($item['celular']))
				{
					$this->insereTelefoneCelular($this->conn, $item, $recurso = 'celular', $idfornecedor);
				}

				/* Trait - Insere Email se houver */
				if(isset($item['email']))
				{
					$this->insereEmail($this->conn, $item['email'], $idfornecedor);
				}
			}

			$resultado->retorno = "OK";

		}
		catch(\PDOException $e)
		{
			return $resultado = "Erro ao converter dados fornecedor ".$e->getMessage();
		}

		return $resultado;
	}
}