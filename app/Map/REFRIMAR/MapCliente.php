<?php

namespace APP\Map;

use APP\Services\Functions\Funcoes;

class MapCliente
{
	/**
	* @param $data Array de objetos a serem tratados
	* @param $idempresa id da empresa nova a gravar nas tabelas
	* @return Retorna o array com os objetos a serem gravados
	*
	* OBS: Seto alguns dados iniciais no começo da classe, caso existir
	* 		eu crio um novo objeto com os dados, assim não preciso ficar
	*		instanciando um objeto toda hora
	*/

	public function trataDados($data, $idempresa)
	{
		$arr = [];
		$arrDados = [];

		foreach($data as $key => $item)
		{

			$dados 		= new \stdClass();

			$telefoneSN 	= (isset($item->TEL_CLIFOR) || $item->TEL_CLIFOR != '') ? true : false;
			$celularSN 		= (isset($item->CEL_CLIFOR) || $item->CEL_CLIFOR != '') ? true : false;
			$emailSN 		= (isset($item->EMAIL) || $item->EMAIL != '') ? true : false;

			$dados->idcliente 				= $item->CODIGO;
		    $dados->ativo   				= (isset($item->SITUACAO_AI) || $item->SITUACAO_AI != '') ? $item->SITUACAO_AI : 'A';
		    $dados->fisicajuridica  		= ($item->FIS_JUR == 'Pes. Física') ? 'F' : 'J';
		    $dados->cpfcnpj 				= Funcoes::trataNumeros($item->CPF_CNPJ);
		    $dados->ierg    				= null;
		    $dados->razaonome   			= Funcoes::trataString($item->RAZAO_NOME);
		    $dados->nomefantasia   			= Funcoes::trataString($item->RAZAO_NOME);
		    $dados->idusuario   			= 1;
		    $dados->cep 					= Funcoes::trataNumeros($item->CEPCLIFOR);
		    $dados->logradouro  			= Funcoes::filtraLogradouro($item->ENDCLIFOR);
		    $dados->endereco    			= Funcoes::filtraEndereco($item->ENDCLIFOR);
		    $dados->numero  				= Funcoes::filtraNumero($item->ENDCLIFOR);
		    $dados->bairro  				= Funcoes::trataString($item->BAICLIFOR);
		    $dados->complemento 			= $item->COMCLIFOR;
		    $dados->cepentrega  			= Funcoes::trataNumeros($item->CEP_ENTREGA);
		    $dados->logradouroentrega   	= Funcoes::filtraLogradouro($item->END_ENTREGA);
		    $dados->enderecoentrega 		= Funcoes::filtraEndereco($item->END_ENTREGA);
		    $dados->numeroentrega   		= Funcoes::filtraNumero($item->END_ENTREGA);
		    $dados->bairroentrega   		= Funcoes::trataString($item->BAI_ENTREGA);
		    $dados->complementoentrega  	= $item->COM_ENTREGA;
		    $dados->cepcobranca 			= Funcoes::trataNumeros($item->CEP_COBRANCA);
		    $dados->logradourocobranca  	= Funcoes::filtraLogradouro($item->END_COBRANCA);
		    $dados->enderecocobranca    	= Funcoes::filtraEndereco($item->END_COBRANCA);
		    $dados->numerocobranca  		= Funcoes::filtraNumero($item->END_COBRANCA);
		    $dados->bairrocobranca  		= Funcoes::trataString($item->BAI_COBRANCA);
		    $dados->complementocobranca 	= $item->COM_COBRANCA;
		    $municipio 						= ($item->CIDCLIFOR != "") ? Funcoes::buscaMunicipio($item->CIDCLIFOR) : null;
		    $dados->idmunicipio 			= $municipio->idmunicipio;
		    $dados->datanascimento  		= $item->DTA_NAS;
		    $dados->nomeconjugue    		= Funcoes::trataString($item->NOME_CONJUGE);
		    $dados->datanascimentoconjugue  = $item->DTA_NASCTO_CONJUGE;
		    $dados->observacao  			= $item->OBSERVACAO;
		    $dados->limitecredito   		= $item->LIMITE_CREDITO;
		    $dados->valorultimofaturamento  = $item->VLR_ULTIMA_COMPRA;
		    $dados->dataultimofaturamento   = $item->DTA_ULTIMA_COMPRA;
		    $dados->valormaiorfaturamento   = null;
		    $dados->valortotalfaturamento   = $item->ACUMULATIVO_COMPRA;
		    $dados->valoracumuladopremiacao = null;
		    $dados->valorresgatadopremiacao = null;
		    $dados->negativado  			= null;
		    $dados->bloqueado   			= $item->BLOQUEADO_SN;
		   	$dados->datacadastro    		= $item->DTA_CAD;
		    $dados->idempresa   			= $idempresa;
		    $dados->idmunicipiocobranca 	= $dados->idmunicipio;
		    $dados->idmunicipioentrega  	= $dados->idmunicipio;
		    $dados->senhaacesso 			= null;
		    $dados->idempresamunicipio 		= $idempresa;

		    $arrDados['dados'] 				= $dados;

		  	/* TELEFONE */
		    if($telefoneSN)
		    {
		    	$telefone = new \stdClass();
		    	$telefone->idtelefone 			= null;
			    $telefone->idparceiro 			= null;
			    $telefone->identificacao 		= 'C';
			    $telefone->ddd 					= Funcoes::trataDDD($item->TEL_CLIFOR);
			    $telefone->telefone				= Funcoes::trataTelefone($item->TEL_CLIFOR);
			    $telefone->ramal 				= null;
			    $telefone->contato 				= $item->CONTATO;
			    $telefone->operadora 			= null;
			    $telefone->padrao 				= true;
			    $telefone->idempresa 			= $idempresa;

			    $arrDados['telefone'] 			= $telefone;
		    }


		    /* CELULAR */
		    if($celularSN)
		    {
		    	$celular = new \stdClass();
		    	$celular->idtelefone 			= null;
			    $celular->idparceiro 			= null;
			    $celular->identificacao 		= 'C';
			    $celular->ddd 					= Funcoes::trataDDD($item->CEL_CLIFOR);
			    $celular->telefone				= Funcoes::trataTelefone($item->CEL_CLIFOR);
			    $celular->ramal 				= null;
			    $celular->contato 				= $item->CONTATO;
			    $celular->operadora 			= null;
			    $celular->padrao 				= true;
			    $celular->idempresa 			= $idempresa;

			    $arrDados['celular'] 			= $celular;
		    }


		    /* EMAIL */
		    if($emailSN)
		    {
		    	$email = new \stdClass();
		    	$email->idemail 				= null;
			    $email->idparceiro 				= null;
			    $email->identificacao 			= 'C';
			    $email->email 					= $item->EMAIL;
			    $email->contato 				= $item->CONTATO;
			    $email->idsetor 				= null;
			    $email->observacao 				= null;
			    $email->datacadastro 			= $item->DTA_CAD;
			    $email->idempresa 				= $idempresa;
			    $email->idempresasetor 			= null;

			    $arrDados['email'] 				= $email;
		    }

			$arr[$key] = $arrDados;
		}

		return $arr;
	}
}