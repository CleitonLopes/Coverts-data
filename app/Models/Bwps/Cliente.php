<?php

namespace APP\Models\Bwps;

use APP\Interfaces\ConexaoInterface;
use APP\Traits\Bwps\TelefoneCelular;
use APP\Traits\Bwps\Email;

class Cliente
{
	use TelefoneCelular;
	use Email;

	private $conn;

	public function __construct(ConexaoInterface $conexao)
	{
		$this->conn = $conexao->connect();
	}


	public function selecionaMaiorCliente()
	{

		try
		{
			$stmt = $this->conn->prepare('SELECT max(idcliente) as maior FROM cliente');
			$stmt->execute();

			$idcliente = 1;

			if($idcliente = $stmt->fetch(\PDO::FETCH_OBJ))
			{
				$idcliente = $idcliente->maior + 1;
			}
		}
		catch(Exception $e)
		{
			return  $e->getMessage();
		}

		return $idcliente;
	}


	public function create($data, $increment)
	{
		$resultado = new \stdClass();

		try
		{
			foreach($data as $item)
			{

				if($increment)
				{
					$idcliente = $this->selecionaMaiorCliente();
					$item['dados']->idcliente = $idcliente;
				}


				$stmt = $this->conn->prepare('INSERT INTO cliente(idcliente, ativo, fisicajuridica, cpfcnpj, ierg, razaonome, nomefantasia, idusuario, cep,
															logradouro, endereco, numero, bairro, complemento, cepentrega, logradouroentrega, enderecoentrega,
															numeroentrega, bairroentrega, complementoentrega, cepcobranca, logradourocobranca, enderecocobranca,
															numerocobranca, bairrocobranca, complementocobranca, idmunicipio, datanascimento, nomeconjugue,
															datanascimentoconjugue, observacao, limitecredito, valorultimofaturamento, dataultimofaturamento,
															valormaiorfaturamento, valortotalfaturamento, valoracumuladopremiacao, valorresgatadopremiacao,
															negativado, bloqueado, datacadastro, idempresa, idmunicipiocobranca, idmunicipioentrega, senhaacesso,
															idempresamunicipio)

													  VALUES(:idcliente, :ativo, :fisicajuridica, :cpfcnpj, :ierg, :razaonome, :nomefantasia, :idusuario, :cep,
															:logradouro, :endereco, :numero, :bairro, :complemento, :cepentrega, :logradouroentrega, :enderecoentrega,
															:numeroentrega, :bairroentrega, :complementoentrega, :cepcobranca, :logradourocobranca, :enderecocobranca,
															:numerocobranca, :bairrocobranca, :complementocobranca, :idmunicipio, :datanascimento, :nomeconjugue,
															:datanascimentoconjugue, :observacao, :limitecredito, :valorultimofaturamento, :dataultimofaturamento,
															:valormaiorfaturamento, :valortotalfaturamento, :valoracumuladopremiacao, :valorresgatadopremiacao,
															:negativado, :bloqueado, :datacadastro, :idempresa, :idmunicipiocobranca, :idmunicipioentrega, :senhaacesso,
															:idempresamunicipio)');

				$stmt->bindParam(':idcliente', 					$item['dados']->idcliente, 					\PDO::PARAM_INT);
				$stmt->bindParam(':ativo', 						$item['dados']->ativo, 						\PDO::PARAM_STR);
				$stmt->bindParam(':fisicajuridica', 			$item['dados']->fisicajuridica, 			\PDO::PARAM_STR);
				$stmt->bindParam(':cpfcnpj', 					$item['dados']->cpfcnpj, 					\PDO::PARAM_STR);
				$stmt->bindParam(':ierg', 						$item['dados']->ierg, 						\PDO::PARAM_STR);
				$stmt->bindParam(':razaonome', 					$item['dados']->razaonome, 					\PDO::PARAM_STR);
				$stmt->bindParam(':nomefantasia', 				$item['dados']->nomefantasia, 				\PDO::PARAM_STR);
				$stmt->bindParam(':idusuario', 					$item['dados']->idusuario, 					\PDO::PARAM_STR);
				$stmt->bindParam(':cep', 						$item['dados']->cep, 						\PDO::PARAM_STR);
				$stmt->bindParam(':logradouro', 				$item['dados']->logradouro, 				\PDO::PARAM_STR);
				$stmt->bindParam(':endereco',					$item['dados']->endereco, 					\PDO::PARAM_STR);
				$stmt->bindParam(':numero',						$item['dados']->numero,						\PDO::PARAM_STR);
				$stmt->bindParam(':bairro',						$item['dados']->bairro,						\PDO::PARAM_STR);
				$stmt->bindParam(':complemento',				$item['dados']->complemento,				\PDO::PARAM_STR);
				$stmt->bindParam(':cepentrega',					$item['dados']->cepentrega,					\PDO::PARAM_STR);
				$stmt->bindParam(':logradouroentrega',			$item['dados']->logradouroentrega,			\PDO::PARAM_STR);
				$stmt->bindParam(':enderecoentrega',			$item['dados']->enderecoentrega,			\PDO::PARAM_STR);
				$stmt->bindParam(':numeroentrega',				$item['dados']->numeroentrega, 				\PDO::PARAM_STR);
				$stmt->bindParam(':bairroentrega',				$item['dados']->bairroentrega,				\PDO::PARAM_STR);
				$stmt->bindParam(':complementoentrega',			$item['dados']->complementoentrega,			\PDO::PARAM_STR);
				$stmt->bindParam(':cepcobranca',				$item['dados']->cepcobranca,				\PDO::PARAM_STR);
				$stmt->bindParam(':logradourocobranca',			$item['dados']->logradourocobranca,			\PDO::PARAM_STR);
				$stmt->bindParam(':enderecocobranca',			$item['dados']->enderecocobranca,			\PDO::PARAM_STR);
				$stmt->bindParam(':numerocobranca',				$item['dados']->numerocobranca,				\PDO::PARAM_STR);
				$stmt->bindParam(':bairrocobranca',				$item['dados']->bairrocobranca,				\PDO::PARAM_STR);
				$stmt->bindParam(':complementocobranca',		$item['dados']->complementocobranca,		\PDO::PARAM_STR);
				$stmt->bindParam(':idmunicipio',				$item['dados']->idmunicipio,				\PDO::PARAM_STR);
				$stmt->bindParam(':datanascimento',				$item['dados']->datanascimento,				\PDO::PARAM_STR);
				$stmt->bindParam(':nomeconjugue',				$item['dados']->nomeconjugue,				\PDO::PARAM_STR);
				$stmt->bindParam(':datanascimentoconjugue',		$item['dados']->datanascimentoconjugue, 	\PDO::PARAM_STR);
				$stmt->bindParam(':observacao',					$item['dados']->observacao, 				\PDO::PARAM_STR);
				$stmt->bindParam(':limitecredito',				$item['dados']->limitecredito,				\PDO::PARAM_STR);
				$stmt->bindParam(':valorultimofaturamento',		$item['dados']->valorultimofaturamento,		\PDO::PARAM_STR);
				$stmt->bindParam(':dataultimofaturamento',		$item['dados']->dataultimofaturamento,		\PDO::PARAM_STR);
				$stmt->bindParam(':valormaiorfaturamento',		$item['dados']->valormaiorfaturamento,		\PDO::PARAM_STR);
				$stmt->bindParam(':valortotalfaturamento',		$item['dados']->valortotalfaturamento,		\PDO::PARAM_STR);
				$stmt->bindParam(':valoracumuladopremiacao',	$item['dados']->valoracumuladopremiacao,	\PDO::PARAM_STR);
				$stmt->bindParam(':valorresgatadopremiacao',	$item['dados']->valorresgatadopremiacao, 	\PDO::PARAM_STR);
				$stmt->bindParam(':negativado',					$item['dados']->negativado, 				\PDO::PARAM_STR);
				$stmt->bindParam(':bloqueado',					$item['dados']->bloqueado,					\PDO::PARAM_STR);
				$stmt->bindParam(':datacadastro',				$item['dados']->datacadastro,				\PDO::PARAM_STR);
				$stmt->bindParam(':idempresa',					$item['dados']->idempresa,					\PDO::PARAM_STR);
				$stmt->bindParam(':idmunicipiocobranca',		$item['dados']->idmunicipiocobranca,		\PDO::PARAM_STR);
				$stmt->bindParam(':idmunicipioentrega',			$item['dados']->idmunicipioentrega,			\PDO::PARAM_STR);
				$stmt->bindParam(':senhaacesso',				$item['dados']->senhaacesso,				\PDO::PARAM_STR);
				$stmt->bindParam(':idempresamunicipio',			$item['dados']->idempresamunicipio,			\PDO::PARAM_STR);
				$stmt->execute();


				/* Trait - Insere Telefone se houver */
				if(isset($item['telefone']))
				{
					$this->insereTelefoneCelular($this->conn, $item, $recurso = 'telefone', $idcliente);
				}

				/* Trait - Insere Celular se houver */
				if(isset($item['celular']))
				{
					$this->insereTelefoneCelular($this->conn, $item, $recurso = 'celular', $idcliente);
				}

				/* Trait - Insere Email se houver */
				if(isset($item['email']))
				{
					$this->insereEmail($this->conn, $item['email'], $idcliente);
				}

			}


			$resultado->retorno = "OK";

		}
		catch(\PDOException $e)
		{
			return $e->getMessage();
		}

		return $resultado;
	}
}