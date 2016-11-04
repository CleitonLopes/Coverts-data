<?php

namespace APP\Models\Bwps;

use APP\Interfaces\ConexaoInterface;

class Produto
{

	private $conn;

	public function __construct(ConexaoInterface $conexao)
	{
		$this->conn = $conexao->connect();
	}

	public function createLinha($data, $increment)
	{
		$resultado = new \stdClass();

		try
		{
			foreach($data as $item)
			{
				$stmt = $this->conn->prepare('INSERT INTO linha(idlinha, idempresa, descricao)
												VALUES(:idlinha, :idempresa, :descricao)');

				$stmt->bindParam(':idlinha', $item->idlinha, \PDO::PARAM_INT);
				$stmt->bindParam(':idempresa', $item->idempresa, \PDO::PARAM_STR);
				$stmt->bindParam(':descricao', $item->descricao, \PDO::PARAM_STR);
				$stmt->execute();

			}

			$resultado->retorno = "OK";

		}
		catch(\PDOException $e)
		{
			return $e->getMessage();
		}

		return $resultado;
	}

	public function createGrupo($data, $increment)
	{
		$resultado = new \stdClass();

		try
		{
			foreach($data as $item)
			{
				$stmt = $this->conn->prepare('INSERT INTO grupo(idgrupo, idempresa, descricao, idlinha, idempresalinha)
												VALUES(:idgrupo, :idempresa, :descricao, :idlinha, :idempresalinha)');

				$stmt->bindParam(':idgrupo', $item->idgrupo, \PDO::PARAM_INT);
				$stmt->bindParam(':idempresa', $item->idempresa, \PDO::PARAM_STR);
				$stmt->bindParam(':descricao', $item->descricao, \PDO::PARAM_STR);
				$stmt->bindParam(':idlinha', $item->idlinha, \PDO::PARAM_STR);
				$stmt->bindParam(':idempresalinha', $item->idempresalinha, \PDO::PARAM_STR);
				$stmt->execute();

			}

			$resultado->retorno = "OK";

		}
		catch(\PDOException $e)
		{
			return $e->getMessage();
		}

		return $resultado;
	}

	public function selecionaMaiorProduto()
	{
		try
		{
			$stmt = $this->conn->prepare('SELECT max(idproduto) as maior FROM produto');
			$stmt->execute();

			$idproduto = 1;
			if($idproduto = $stmt->fetch(\PDO::FETCH_OBJ))
			{
				$idproduto = $idproduto->maior + 1;
			}
		}
		catch(\PDOException $e)
		{
			return $e->getMessage();
		}

		return $idproduto;
	}

	public function createSubGrupo($data, $increment)
	{
		$resultado = new \stdClass();

		try
		{
			foreach($data as $item)
			{
				$stmt = $this->conn->prepare('INSERT INTO subgrupo(idsubgrupo, idempresa, descricao, idgrupo, idempresagrupo)
												VALUES(:idsubgrupo, :idempresa, :descricao, :idgrupo, :idempresagrupo)');

				$stmt->bindParam(':idsubgrupo', $item->idsubgrupo, \PDO::PARAM_INT);
				$stmt->bindParam(':idempresa', $item->idempresa, \PDO::PARAM_STR);
				$stmt->bindParam(':descricao', $item->descricao, \PDO::PARAM_STR);
				$stmt->bindParam(':idgrupo', $item->idgrupo, \PDO::PARAM_STR);
				$stmt->bindParam(':idempresagrupo', $item->idempresagrupo, \PDO::PARAM_STR);
				$stmt->execute();

			}

			$resultado->retorno = "OK";

		}
		catch(\PDOException $e)
		{
			return $e->getMessage();
		}

		return $resultado;
	}

	public function createProduto($data, $increment)
	{
		$resultado = new \stdClass();
		try
		{
			foreach($data as $item)
			{
				if($increment)
				{
					$idproduto = $this->selecionaMaiorProduto();
					$item['dados']->idproduto = $idproduto;
				}

				//return $item['saldo'];

				$stmt = $this->conn->prepare('INSERT INTO produto(idproduto, idlinha, idgrupo, idsubgrupo, descricao, complemento,
																codigofabricante, codigobarras, localizacao, idunidade, ativosn,
																foradelinhasn, pesoliquido, pesobruto, qtdecaixa, qtdeminima, descontosn,
																percmaxdesconto, iniciopromocao, fimpromocao, percdesctopromocao, codigoecommerce,
																variacaoecommerce, perccomissao, idtributos, idclassfiscal, idtipoproduto, idfornecedor,
																dataultimacompra, dataultimavenda, qtdeultimacompra, qtdeultimavenda, precocompra, precofretecompra,
																precocustocompra, precocustomediocompra, percipicompra, idfornecedorultimacompra, datacadastro,
																idempresa, idempresatributos, idempresaclassfiscal, idempresatipoproduto, idempresafornecedor,
																idempresalinha, idempresagrupo, idempresasubgrupo, idempresaunidade, idempresafornecedorultimacompra,
																idusuario, precoultimacompra, tempoinstalacao, nfci, origem, codigoANP)

														VALUES(:idproduto, :idlinha, :idgrupo, :idsubgrupo, :descricao, :complemento,
																:codigofabricante, :codigobarras, :localizacao, :idunidade, :ativosn,
																:foradelinhasn, :pesoliquido, :pesobruto, :qtdecaixa, :qtdeminima, :descontosn,
																:percmaxdesconto, :iniciopromocao, :fimpromocao, :percdesctopromocao, :codigoecommerce,
																:variacaoecommerce, :perccomissao, :idtributos, :idclassfiscal, :idtipoproduto, :idfornecedor,
																:dataultimacompra, :dataultimavenda, :qtdeultimacompra, :qtdeultimavenda, :precocompra, :precofretecompra,
																:precocustocompra, :precocustomediocompra, :percipicompra, :idfornecedorultimacompra, :datacadastro,
																:idempresa, :idempresatributos, :idempresaclassfiscal, :idempresatipoproduto, :idempresafornecedor,
																:idempresalinha, :idempresagrupo, :idempresasubgrupo, :idempresaunidade, :idempresafornecedorultimacompra,
																:idusuario, :precoultimacompra, :tempoinstalacao, :nfci, :origem, :codigoANP)');




					$stmt->bindParam(':idproduto',							$item['dados']->idproduto, 							\PDO::PARAM_INT);
					$stmt->bindParam(':idlinha',							$item['dados']->idlinha, 							\PDO::PARAM_STR);
					$stmt->bindParam(':idgrupo',							$item['dados']->idgrupo, 							\PDO::PARAM_STR);
					$stmt->bindParam(':idsubgrupo',							$item['dados']->idsubgrupo, 						\PDO::PARAM_STR);
					$stmt->bindParam(':descricao',							$item['dados']->descricao, 							\PDO::PARAM_STR);
					$stmt->bindParam(':complemento',						$item['dados']->complemento, 						\PDO::PARAM_STR);
					$stmt->bindParam(':codigofabricante',					$item['dados']->codigofabricante, 					\PDO::PARAM_STR);
					$stmt->bindParam(':codigobarras',						$item['dados']->codigobarras, 						\PDO::PARAM_STR);
					$stmt->bindParam(':localizacao',						$item['dados']->localizacao, 						\PDO::PARAM_STR);
					$stmt->bindParam(':idunidade',							$item['dados']->idunidade, 							\PDO::PARAM_STR);
					$stmt->bindParam(':ativosn',							$item['dados']->ativosn, 							\PDO::PARAM_STR);
					$stmt->bindParam(':foradelinhasn',						$item['dados']->foradelinhasn, 						\PDO::PARAM_STR);
					$stmt->bindParam(':pesoliquido',						$item['dados']->pesoliquido, 						\PDO::PARAM_STR);
					$stmt->bindParam(':pesobruto',							$item['dados']->pesobruto, 							\PDO::PARAM_STR);
					$stmt->bindParam(':qtdecaixa',							$item['dados']->qtdecaixa, 							\PDO::PARAM_STR);
					$stmt->bindParam(':qtdeminima',							$item['dados']->qtdeminima, 						\PDO::PARAM_STR);
					$stmt->bindParam(':descontosn',							$item['dados']->descontosn, 						\PDO::PARAM_STR);
					$stmt->bindParam(':percmaxdesconto',					$item['dados']->percmaxdesconto, 					\PDO::PARAM_STR);
					$stmt->bindParam(':iniciopromocao',						$item['dados']->iniciopromocao, 					\PDO::PARAM_STR);
					$stmt->bindParam(':fimpromocao',						$item['dados']->fimpromocao, 						\PDO::PARAM_STR);
					$stmt->bindParam(':percdesctopromocao',					$item['dados']->percdesctopromocao, 				\PDO::PARAM_STR);
					$stmt->bindParam(':codigoecommerce',					$item['dados']->codigoecommerce, 					\PDO::PARAM_STR);
					$stmt->bindParam(':variacaoecommerce',					$item['dados']->variacaoecommerce, 					\PDO::PARAM_STR);
					$stmt->bindParam(':perccomissao',						$item['dados']->perccomissao, 						\PDO::PARAM_STR);
					$stmt->bindParam(':idtributos',							$item['dados']->idtributos, 						\PDO::PARAM_STR);
					$stmt->bindParam(':idclassfiscal',						$item['dados']->idclassfiscal, 						\PDO::PARAM_STR);
					$stmt->bindParam(':idtipoproduto',						$item['dados']->idtipoproduto, 						\PDO::PARAM_STR);
					$stmt->bindParam(':idfornecedor',						$item['dados']->idfornecedor, 						\PDO::PARAM_STR);
					$stmt->bindParam(':dataultimacompra',					$item['dados']->dataultimacompra, 					\PDO::PARAM_STR);
					$stmt->bindParam(':dataultimavenda',					$item['dados']->dataultimavenda, 					\PDO::PARAM_STR);
					$stmt->bindParam(':qtdeultimacompra',					$item['dados']->qtdeultimacompra, 					\PDO::PARAM_STR);
					$stmt->bindParam(':qtdeultimavenda',					$item['dados']->qtdeultimavenda, 					\PDO::PARAM_STR);
					$stmt->bindParam(':precocompra',						$item['dados']->precocompra, 						\PDO::PARAM_STR);
					$stmt->bindParam(':precofretecompra',					$item['dados']->precofretecompra, 					\PDO::PARAM_STR);
					$stmt->bindParam(':precocustocompra',					$item['dados']->precocustocompra, 					\PDO::PARAM_STR);
					$stmt->bindParam(':precocustomediocompra',				$item['dados']->precocustomediocompra, 				\PDO::PARAM_STR);
					$stmt->bindParam(':percipicompra',						$item['dados']->percipicompra, 						\PDO::PARAM_STR);
					$stmt->bindParam(':idfornecedorultimacompra',			$item['dados']->idfornecedorultimacompra, 			\PDO::PARAM_STR);
					$stmt->bindParam(':datacadastro',						$item['dados']->datacadastro, 						\PDO::PARAM_STR);
					$stmt->bindParam(':idempresa',							$item['dados']->idempresa, 							\PDO::PARAM_STR);
					$stmt->bindParam(':idempresatributos',					$item['dados']->idempresatributos, 					\PDO::PARAM_STR);
					$stmt->bindParam(':idempresaclassfiscal',				$item['dados']->idempresaclassfiscal, 				\PDO::PARAM_STR);
					$stmt->bindParam(':idempresatipoproduto',				$item['dados']->idempresatipoproduto, 				\PDO::PARAM_STR);
					$stmt->bindParam(':idempresafornecedor',				$item['dados']->idempresafornecedor,	 			\PDO::PARAM_STR);
					$stmt->bindParam(':idempresalinha',						$item['dados']->idempresalinha, 					\PDO::PARAM_STR);
					$stmt->bindParam(':idempresagrupo',						$item['dados']->idempresagrupo, 					\PDO::PARAM_STR);
					$stmt->bindParam(':idempresasubgrupo',					$item['dados']->idempresasubgrupo, 					\PDO::PARAM_STR);
					$stmt->bindParam(':idempresaunidade',					$item['dados']->idempresaunidade, 					\PDO::PARAM_STR);
					$stmt->bindParam(':idempresafornecedorultimacompra',	$item['dados']->idempresafornecedorultimacompra, 	\PDO::PARAM_STR);
					$stmt->bindParam(':idusuario',							$item['dados']->idusuario, 							\PDO::PARAM_STR);
					$stmt->bindParam(':precoultimacompra',					$item['dados']->precoultimacompra, 					\PDO::PARAM_STR);
					$stmt->bindParam(':tempoinstalacao',					$item['dados']->tempoinstalacao, 					\PDO::PARAM_STR);
					$stmt->bindParam(':nfci',								$item['dados']->nfci, 								\PDO::PARAM_STR);
					$stmt->bindParam(':origem',								$item['dados']->origem, 							\PDO::PARAM_STR);
					$stmt->bindParam(':codigoANP',							$item['dados']->codigoanp, 							\PDO::PARAM_STR);
					$stmt->execute();


				if(isset($item['saldo']))
				{
					$this->insereSaldo($item);
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

	public function insereSaldo($item)
	{
		$resultado = new \stdClass();

		try
		{

			$stmt = $this->conn->prepare('SELECT max(idprodutosaldo) as maior FROM produtosaldo');
			$stmt->execute();

			$idprodutosaldo = 1;
			if($idprodutosaldo = $stmt->fetch(\PDO::FETCH_OBJ))
			{
				$idprodutosaldo = $idprodutosaldo->maior + 1;
			}

			$stmt = $this->conn->prepare('INSERT INTO produtosaldo(idprodutosaldo, idproduto, saldo, saldo_operacional, dataalteracao, idempresa)
														VALUES(:idprodutosaldo, :idproduto, :saldo, :saldo_operacional, :dataalteracao, :idempresa)');
			$stmt->bindParam(':idprodutosaldo', 	$idprodutosaldo, 					\PDO::PARAM_INT);
			$stmt->bindParam(':idproduto', 			$item['dados']->idproduto, 			\PDO::PARAM_INT);
			$stmt->bindParam(':saldo', 				$item['saldo']->saldo, 				\PDO::PARAM_STR);
			$stmt->bindParam(':saldo_operacional', 	$item['saldo']->saldo_operacional, 	\PDO::PARAM_STR);
			$stmt->bindParam(':dataalteracao', 		$item['saldo']->dataalteracao, 		\PDO::PARAM_STR);
			$stmt->bindParam(':idempresa', 			$item['saldo']->idempresa, 			\PDO::PARAM_INT);
			$stmt->execute();


			$resultado->retorno = "OK";

		}
		catch(\PDOException $e)
		{
			return $e->getMessage();
		}

		return $resultado;
	}
}