<?php

namespace APP\Map;

use APP\Services\Functions\Funcoes;

class MapFornecedor
{
	/**
	* @param $data Array de objetos a serem tratados
	* @param $idempresa String da empresa nova a gravar nas tabelas
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

		try
		{
			foreach($data as $key => $item)
			{
				$dados = new \stdClass();

				$telefoneSN 	= (isset($item->TEL_CLIFOR) || $item->TEL_CLIFOR != '') ? true : false;
				$celularSN 		= (isset($item->CEL_CLIFOR) || $item->CEL_CLIFOR != '') ? true : false;
				$emailSN 		= (isset($item->EMAIL) || $item->EMAIL != '') ? true : false;

				$dados->idfornecedor            = $item->CODIGO;
				$dados->ativo                   = (isset($item->SITUACAO_AI) || $item->SITUACAO_AI != '') ? $item->SITUACAO_AI : 'A';
				$dados->fisicajuridica          = ($item->FIS_JUR == 'Pes. Física') ? 'F' : 'J';
				$dados->cpfcnpj                 = Funcoes::trataNumeros($item->CPF_CNPJ);
				$dados->ierg                    = null;
				$dados->razaonome               = Funcoes::trataString($item->RAZAO_NOME);
				$dados->nomefantasia            = Funcoes::trataString($item->RAZAO_NOME);
				$dados->cep                     = Funcoes::trataNumeros($item->CEPCLIFOR);
				$dados->logradouro              = Funcoes::filtraLogradouro($item->ENDCLIFOR);
				$dados->endereco                = Funcoes::filtraEndereco($item->ENDCLIFOR);
				$dados->numero                  = Funcoes::filtraNumero($item->ENDCLIFOR);
				$dados->bairro                  = Funcoes::trataString($item->BAICLIFOR);
				$dados->complemento             = $item->COMCLIFOR;
				$dados->datacadastro            = $item->DTA_CAD;
				$municipio 						= ($item->CIDCLIFOR != "") ? Funcoes::buscaMunicipio($item->CIDCLIFOR) : null;
		    	$dados->idmunicipio 			= $municipio->idmunicipio;
				$dados->idplanoconta            = null;
				$dados->idempresa               = $idempresa;
				$dados->idusuario               = 1;
				$dados->idempresaplanoconta     = null;
				$dados->idempresamunicipio      = 1;
				$dados->idempresausuario        = 1;

				$arrDados['dados'] 				= $dados;

			  	/* TELEFONE */
			    if($telefoneSN)
			    {
			    	$telefone = new \stdClass();
			    	$telefone->idtelefone 			= null;
				    $telefone->idparceiro 			= null;
				    $telefone->identificacao 		= 'F';
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
				    $celular->identificacao 		= 'F';
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
				    $email->identificacao 			= 'F';
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

		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}

		return $arr;
	}
}