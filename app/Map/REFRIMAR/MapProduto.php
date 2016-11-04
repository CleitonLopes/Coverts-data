<?php

namespace APP\Map;

use APP\Services\Functions\Funcoes;


class MapProduto
{

	public function trataLinha($data, $idempresa)
	{
		$arr = [];

		foreach($data as $key => $item)
		{
			$dados = new \stdClass();


			$dados->idlinha 	= $item->CODIGO;
			$dados->idempresa 	= $idempresa;
			$dados->descricao	= Funcoes::trataString($item->DESCRICAO);

			$arr[$key] = $dados;
		}

		return $arr;
	}

	public function trataGrupo($data, $idempresa)
	{
		$arr = [];

		foreach($data as $key => $item)
		{
			$dados = new \stdClass();


			$dados->idgrupo 		= $item->CODIGO;
			$dados->idempresa 		= $idempresa;
			$dados->descricao 		= Funcoes::trataString($item->DESCRICAO);
			$dados->idlinha 		= 241;
			$dados->idempresalinha 	= 21;

			$arr[$key] = $dados;
		}

		return $arr;
	}

	public function trataSubGrupo($data, $idempresa)
	{
		$arr = [];

		foreach($data as $key => $item)
		{
			$dados = new \stdClass();


			$dados->idsubgrupo = $item->SGP_CODIGO;
			$dados->idempresa 	= $idempresa;
			$dados->descricao 	= Funcoes::trataString($item->SGP_DESCRICAO);
			$dados->idgrupo 	= 27;
			$dados->idempresagrupo = $idempresa;

			$arr[$key] = $dados;
		}

		return $arr;
	}

	public function trataProduto($data, $idempresa)
	{
		$arr = [];
		$arrDados = [];

		foreach($data as $key => $item)
		{
			$dados = new \stdClass();

			$saldo = new \stdClass();

			$dados->idproduto 							= $item->COD_PRODUTO;
			$dados->idlinha    							= $item->COD_LINHA;
			$dados->idgrupo    							= $item->COD_GRUPO;
			$dados->idsubgrupo    						= 1;//$item->COD_SUB_GRUPO;
			$dados->descricao    						= ($item->DESC_PRODUTO == '') ? "SEM DESCRIÇÂO " : Funcoes::trataString($item->DESC_PRODUTO);
			$dados->complemento    						= $item->OBS_COMPLEMENTO;
			$dados->codigofabricante    				= $item->COD_FABRICANTE;
			$dados->codigobarras    					= null;//$item->COD_BARRA;
			$dados->localizacao    						= null;
			$dados->idunidade    						= 1; // criar;
			$dados->ativosn    							= ($item->ATIVO_INATIVO == 'Ativo') ? 'S' : 'N';
			$dados->foradelinhasn    					= null;
			$dados->pesoliquido    						= $item->PESO_LIQUIDO;
			$dados->pesobruto    						= $item->PESO_BRUTO;
			$dados->qtdecaixa    						= $item->QTDE_CAIXA;
			$dados->qtdeminima    						= $item->MINIMO;
			$dados->descontosn    						= null;
			$dados->percmaxdesconto    					= null;
			$dados->iniciopromocao    					= null;
			$dados->fimpromocao    						= null;
			$dados->percdesctopromocao    				= null;
			$dados->codigoecommerce    					= null;
			$dados->variacaoecommerce    				= null;
			$dados->perccomissao   	 					= null;
			$dados->idtributos    						= 1;
			$idclassfiscal 								= Funcoes::buscaCodigoNCM($item->CLASS_FISCAL, $idempresa);
			$dados->idclassfiscal						= $idclassfiscal->idclassfiscal;//$idclassfiscal->idclassfiscal;
			$dados->idtipoproduto    					= 1; //verificar depois
			$dados->idfornecedor    					= 1; // criar um padrão
			$dados->dataultimacompra    				= $item->DTA_ULTIMA_COMPRA;
			$dados->dataultimavenda    					= $item->DTA_ULTIMA_VENDA;
			$dados->qtdeultimacompra    				= $item->QTDE_ULTIMA_COMPRA;
			$dados->qtdeultimavenda    					= null;
			$dados->precocompra    						= $item->VLR_ULTIMA_COMPRA;
			$dados->precofretecompra    				= $item->VLR_FRETE_ULTIMA_COMPRA;
			$dados->precocustocompra    				= $item->VLR_CUSTO;
			$dados->precocustomediocompra    			= $item->VLR_CUSTO_MEDIO;
			$dados->percipicompra    					= $item->PER_IPI_COMPRA;
			$dados->idfornecedorultimacompra    		= null;
			$dados->datacadastro    					= $item->DATA_CADASTRO;
			$dados->idempresa    						= $idempresa;
			$dados->idempresatributos    				= $idempresa;
			$dados->idempresaclassfiscal    			= $idempresa;
			$dados->idempresatipoproduto    			= $idempresa;
			$dados->idempresafornecedor    				= $idempresa;
			$dados->idempresalinha    					= $idempresa;
			$dados->idempresagrupo    					= $idempresa;
			$dados->idempresasubgrupo    				= $idempresa;
			$dados->idempresaunidade    				= $idempresa;
			$dados->idempresafornecedorultimacompra    	= null;
			$dados->idusuario    						= null;
			$dados->precoultimacompra    				= $item->VLR_ULTIMA_COMPRA;
			$dados->tempoinstalacao    					= null;
			$dados->nfci    							= null;
			$dados->origem    							= "";
			$dados->codigoanp 							= null;$item->CODIGO_ANP;

			/* SALDO */
			$saldo->idprodutosaldo						= null;
			$saldo->idproduto 							= null;
			$saldo->saldo 								= $item->SALDO_ATUAL;
			$saldo->operacional 						= $item->SALDO_OS;
			$saldo->dataalteracao 						= $item->DATA_ALTERACAO_SALDO;
			$saldo->idempresa 							= $idempresa;

			$arr['dados'] = $dados;
			$arr['saldo'] = $saldo;

			$arrDados[$key] = $arr;
		}

		return $arrDados;
	}
}