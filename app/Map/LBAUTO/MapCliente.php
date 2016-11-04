<?php

namespace APP\Map\LBAUTO;

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

			// $telefoneSN 	= (isset($item->TEL_CLIFOR) || $item->TEL_CLIFOR != '') ? true : false;
			// $celularSN 		= (isset($item->CEL_CLIFOR) || $item->CEL_CLIFOR != '') ? true : false;
			// $emailSN 		= (isset($item->EMAIL) || $item->EMAIL != '') ? true : false;

			$dados->idcliente 				= $item->COD;
		    $dados->ativo   				= ($item->BLOQUEAR == 'FALSO') ? 'A' : 'I';
		    $dados->fisicajuridica  		= 'F';
		    $dados->cpfcnpj 				= Funcoes::trataNumeros($item->CPF);
		    $dados->ierg    				= null;
		    $dados->razaonome   			= Funcoes::trataString($item->NOM);
		    $dados->nomefantasia   			= Funcoes::trataString($item->NOM);
		    $dados->idusuario   			= 1;
		    $dados->cep 					= Funcoes::trataNumeros($item->CEP);
		    $dados->logradouro  			= Funcoes::filtraLogradouro($item->RUA);
		    $dados->endereco    			= Funcoes::filtraEndereco($item->RUA);
		    $dados->numero  				= Funcoes::filtraNumero($item->RUA);
		    $dados->bairro  				= Funcoes::trataString($item->BAI);
		    $dados->complemento 			= null;
		    $dados->cepentrega  			= Funcoes::trataNumeros($item->CEP);
		    $dados->logradouroentrega   	= Funcoes::filtraLogradouro($item->RUA);
		    $dados->enderecoentrega 		= Funcoes::filtraEndereco($item->RUA);
		    $dados->numeroentrega   		= Funcoes::filtraNumero($item->RUA);
		    $dados->bairroentrega   		= Funcoes::trataString($item->BAI);
		    $dados->complementoentrega  	= null;
		    $dados->cepcobranca 			= Funcoes::trataNumeros($item->CEP);
		    $dados->logradourocobranca  	= Funcoes::filtraLogradouro($item->RUA);
		    $dados->enderecocobranca    	= Funcoes::filtraEndereco($item->RUA);
		    $dados->numerocobranca  		= Funcoes::filtraNumero($item->RUA);
		    $dados->bairrocobranca  		= Funcoes::trataString($item->BAI);
		    $dados->complementocobranca 	= null;
		    $municipio 						= ($item->CID != "") ? Funcoes::buscaMunicipio($item->CID) : null;
		    $dados->idmunicipio 			= $municipio->idmunicipio;
		    $dados->datanascimento  		= null;
		    $dados->nomeconjugue    		= null;
		    $dados->datanascimentoconjugue  = null;
		    $dados->observacao  			= null;
		    $dados->limitecredito   		= null;
		    $dados->valorultimofaturamento  = null;
		    $dados->dataultimofaturamento   = null;
		    $dados->valormaiorfaturamento   = null;
		    $dados->valortotalfaturamento   = null;
		    $dados->valoracumuladopremiacao = null;
		    $dados->valorresgatadopremiacao = null;
		    $dados->negativado  			= null;
		    $dados->bloqueado   			= ($item->LIBERADO == 'LIBERADO') ? 'N' : 'S';
		   	$dados->datacadastro    		= Funcoes::trataDataMYSQL($item->DATA);
		    $dados->idempresa   			= $idempresa;
		    $dados->idmunicipiocobranca 	= $dados->idmunicipio;
		    $dados->idmunicipioentrega  	= $dados->idmunicipio;
		    $dados->senhaacesso 			= null;
		    $dados->idempresamunicipio 		= $idempresa;

		    $arrDados['dados'] 				= $dados;

		  	/* TELEFONE */
		    // if($telefoneSN)
		    // {
		    // 	$telefone = new \stdClass();
		    // 	$telefone->idtelefone 			= null;
			   //  $telefone->idparceiro 			= null;
			   //  $telefone->identificacao 		= 'C';
			   //  $telefone->ddd 					= Funcoes::trataDDD($item->TEL_CLIFOR);
			   //  $telefone->telefone				= Funcoes::trataTelefone($item->TEL_CLIFOR);
			   //  $telefone->ramal 				= null;
			   //  $telefone->contato 				= $item->CONTATO;
			   //  $telefone->operadora 			= null;
			   //  $telefone->padrao 				= true;
			   //  $telefone->idempresa 			= $idempresa;

			   //  $arrDados['telefone'] 			= $telefone;
		    // }


		    // /* CELULAR */
		    // if($celularSN)
		    // {
		    // 	$celular = new \stdClass();
		    // 	$celular->idtelefone 			= null;
			   //  $celular->idparceiro 			= null;
			   //  $celular->identificacao 		= 'C';
			   //  $celular->ddd 					= Funcoes::trataDDD($item->CEL_CLIFOR);
			   //  $celular->telefone				= Funcoes::trataTelefone($item->CEL_CLIFOR);
			   //  $celular->ramal 				= null;
			   //  $celular->contato 				= $item->CONTATO;
			   //  $celular->operadora 			= null;
			   //  $celular->padrao 				= true;
			   //  $celular->idempresa 			= $idempresa;

			   //  $arrDados['celular'] 			= $celular;
		    // }


		    // /* EMAIL */
		    // if($emailSN)
		    // {
		    // 	$email = new \stdClass();
		    // 	$email->idemail 				= null;
			   //  $email->idparceiro 				= null;
			   //  $email->identificacao 			= 'C';
			   //  $email->email 					= $item->EMAIL;
			   //  $email->contato 				= $item->CONTATO;
			   //  $email->idsetor 				= null;
			   //  $email->observacao 				= null;
			   //  $email->datacadastro 			= $item->DTA_CAD;
			   //  $email->idempresa 				= $idempresa;
			   //  $email->idempresasetor 			= null;

			   //  $arrDados['email'] 				= $email;
		    // }

			$arr[$key] = $arrDados;
		}

		return $arr;
	}
}