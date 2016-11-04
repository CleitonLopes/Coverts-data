<?php

namespace APP\Services\Functions;

use APP\Containers\ServiceContainer;
use APP\Containers\ServiceContainerDB;

class Funcoes
{

	public static function trataString($str)
	{
		$str = strtoupper($str);
		$str = str_replace('Ã', 'A', $str);
		$str = str_replace('Á', 'A', $str);
		$str = str_replace('À', 'A', $str);
		$str = str_replace('Â', 'A', $str);
		$str = str_replace('Ê', 'E', $str);
		$str = str_replace('É', 'E', $str);
		$str = str_replace('È', 'E', $str);
		$str = str_replace('Ì', 'I', $str);
		$str = str_replace('Í', 'I', $str);
		$str = str_replace('Î', 'I', $str);
		$str = str_replace('Ô', 'O', $str);
		$str = str_replace('Ó', 'O', $str);
		$str = str_replace('Ò', 'O', $str);
		$str = str_replace('Õ', 'O', $str);
		$str = str_replace('Ù', 'U', $str);
		$str = str_replace('Ú', 'U', $str);
		$str = str_replace('Û', 'U', $str);
		$str = str_replace('Ç', 'C', $str);

		if(strlen($str) > 80)
		{
			$str = substr($str, 1, 80);
		}

		return $str;
	}

	public static function trataNumeros($num)
	{
		$num = str_replace(',', '', $num);
		$num = str_replace('-', '', $num);
		$num = str_replace('.', '', $num);
		$num = str_replace('/', '', $num);

		return $num;
	}

	public static function trataTelefone($tel)
	{
		// $data = '(014)3554-4185';

		$tel = str_replace('(', '', $tel);
		$tel = str_replace(')', '', $tel);
		$tel = str_replace('-', '', $tel);

		if((strlen($tel)) >= 10)
		{
			$tel = substr($tel, 2, 10);
		}

		return $tel;
	}

	public static function trataDDD($ddd)
	{
		$ddd = str_replace('(', '', $ddd);
		$ddd = str_replace(')', '', $ddd);
		$ddd = str_replace('-', '', $ddd);

		if((strlen($ddd)) > 10)
		{
			$ddd = substr($ddd, 1, 2);
		}
		else
		{
			$ddd = substr($ddd, 0, 2);
		}

	 	return $ddd;
	}

	public static function trataData($data)
	{

		$data = explode('-', $data);

		if(strlen($data[0]) < 2)
		{
			$data[0] = str_pad($data[0], 2, '0', STR_PAD_LEFT);
		}

		if(strlen($data[1]) < 2)
		{
		 	$data[0] = str_pad($data[0], 2, '0', STR_PAD_LEFT);
		}

		if(strlen($data[2]) < 2)
		{
		 	$data[0] = str_pad($data[0], 2, '0', STR_PAD_LEFT);
		}
		else
		{
			if((int)$data[2] > 0 && (int)$data[2] < 15)
			   $data[2] = '20'.$data[2];
			else
			$data[2] = '19'.$data[2];
		}

		return $data;
	}

	// funcão para truncar se vir 0 no codigo do banco a ser importado, se for diferente, ele mostra os outros numeros
	public static function truncate($num)
	{
		if(strlen($num[0] == false))
		{
			$num = substr($num, 1, 3);
		}
		else
		{
			$num = substr($num, 0, 3);
		}

		return $num;
	}

	##
	public static function filtraLogradouro($string)
	{

		$arr = array("RUA", "R", "AVENIDA", "AV", "AV.", "AVE", "RODOVIA");

		$string = strtoupper($string);
		$logradouro = explode(' ', $string);

		$resultado = '';

		if(strlen($logradouro[0]) == 3 && $logradouro[0] == $arr[0])
		{
			$resultado = 'RUA';
		}

		if(strlen($logradouro[0]) == 1 && $logradouro[0] == $arr[1])
		{
			$resultado = 'RUA';
		}

		if(strlen($logradouro[0]) == 7 && $logradouro[0] == $arr[2])
		{
			$resultado = 'AVENIDA';
		}

		if(strlen($logradouro[0]) == 2 && $logradouro[0] == $arr[3])
		{
			$resultado = 'AVENIDA';
		}

		if(strlen($logradouro[0]) == 3 && $logradouro[0] == $arr[4])
		{
			$resultado = 'AVENIDA';
		}

		if(strlen($logradouro[0]) == 3 && $logradouro[0] == $arr[5])
		{
			$resultado = 'AVENIDA';
		}

		if(strlen($logradouro[0]) == 7 && $logradouro[0] == $arr[6])
		{
			$resultado = 'RODOVIA';
		}

		return $resultado;

	}

	public static function filtraUnidade($string)
	{

		switch ($string)
		{
			case 'UN': return 1; break;
			case 'KG': return 2; break;
			case 'MT': return 3; break;
			case 'KL': return 4; break;
			case 'CX': return 5; break;
			case 'KG': return 6; break;
		}

	}

	##
	public static function filtraEndereco($string)
	{

		$string = self::trataString($string);

		$string = str_replace(',', '', $string);

		$arr = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", ".");

		$logradouro = str_replace($arr, '', $string);

		//return $cont = count($logradouro);

		//$logradouro = explode(' ', $logradouro, 2);

		return(trim($logradouro));
	}

	public static function filtraNumero($string)
	{

		$arr = ['A', 'Ã', 'Á', 'B', 'C', 'Ç', 'D', 'E', 'É', 'Ê', 'Ú', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'Ó', 'Ô', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', ':', ',', '-', '/', '.'];

		$string = strtoupper($string);

		$resultado = str_replace($arr, '', $string);

		if(count($resultado > 10))
		{
			return null;
		}

		return trim($resultado);
	}

	public static function buscaMunicipio($string)
	{
		$container = new ServiceContainer();
		$conn = $container->container();

		$pdo = $conn['conexaoBWPS']->connect();

		$string = "%{$string}%";

		try
		{
			$stmt = $pdo->prepare('SELECT idmunicipio FROM municipio where nome LIKE :nome');
			$stmt->bindParam(':nome', $string, \PDO::PARAM_STR);
			$stmt->execute();

			if(!$idmunicipio = $stmt->fetch(\PDO::FETCH_OBJ))
			{
				return null;
			}

		}
		catch(\PDOException $e)
		{
			return $e->getMessage();
		}

		return $idmunicipio;
	}

	// Busca ncm tabela dp b-vendas e retorna o ncm com 8 digitos
	public static function buscaNCMCodigo($codigo)
	{
		$container = new ServiceContainerDB();
		$conn = $container->container();

		$pdo = $conn['conexaoDB']->connect();

		try
		{
			$stmt = $pdo->prepare('SELECT numero FROM class_fisc WHERE CODIGO = :codigo');
			$stmt->bindParam(':codigo', $codigo, \PDO::PARAM_INT);
			$stmt->execute();

			if(!$ncm = $stmt->fetch(\PDO::FETCH_OBJ))
			{
				return null;
			}

			$ncm = $ncm->numero;

		}
		catch(\PDOException $e)
		{
			return $e->getMessage();
		}

		return $ncm;
	}

	// Busca na tabela bwps o codigo do ncm pelo ncm recebido
	public static function buscaCodigoNCM($codigo, $idempresa)
	{
		$container = new ServiceContainer();
		$conn = $container->container();

		$pdo = $conn['conexaoBWPS']->connect();

		$ncm = self::buscaNCMCodigo($codigo);

		try
		{
			// Busca o idclassfiscal;
			$stmt = $pdo->prepare('SELECT idclassfiscal FROM class_fiscal where ncm = :ncm');
			$stmt->bindParam(':ncm', $ncm, \PDO::PARAM_STR);
			$stmt->execute();

			if($idclassfiscal = $stmt->fetch(\PDO::FETCH_OBJ))
			{
				return $idclassfiscal;
			}

			// busca pelo ncm 12345678
			$ncm = '12345678';
			$stmt = $pdo->prepare('SELECT idclassfiscal FROM class_fiscal where ncm = :ncm');
			$stmt->bindParam(':ncm', $ncm, \PDO::PARAM_STR);
			$stmt->execute();

			if($idclassfiscal = $stmt->fetch(\PDO::FETCH_OBJ))
			{
				return $idclassfiscal;
			}


			// Se não encontrar insere
			$stmt = $pdo->prepare('SELECT max(idclassfiscal) as maior FROM class_fiscal');
			$stmt->execute();

			if($idclassfiscalmaior = $stmt->fetch(\PDO::FETCH_OBJ))
			{
				$idclassfiscal = $idclassfiscalmaior->maior + 1;
			}

			$descricao = 'ESSE NCM NÃO EXISTE, INSERIDO POR PADRÃO, POR FAVOR TROQUE PELO NCM DO PRODUTO OU SERVICO CORRETO';
			$piscofins = 'N';
			$tabela = 0;
			$descricaooriginalibpt = "ESSE NCM NÃO EXISTE, INSERIDO POR PADRÃO, POR FAVOR TROQUE PELO NCM DO PRODUTO OU SERVICO CORRETO";
			$ex = null;
			$aliqibptnac = 0;
			$aliqibptimp = 0;
			$aliqestadual = 0;
			$aliqmunicipal = 0;
			$idempresa = $idempresa;
			$idcest = null;
			$idempresacest = null;


			$stmt = $pdo->prepare('INSERT INTO class_fiscal(idclassfiscal, ncm, descricao, piscofins, tabela, descricaooriginalibpt, ex, aliqibptnac,
															aliqibptimp, aliqestadual, aliqmunicipal, idempresa, idcest, idempresacest)
													VALUES(:idclassfiscal, :ncm, :descricao, :piscofins, :tabela, :descricaooriginalibpt, :ex, :aliqibptnac,
															:aliqibptimp, :aliqestadual, :aliqmunicipal, :idempresa, :idcest, :idempresacest)');

			$stmt->bindParam(':idclassfiscal',  		$idclassfiscal, \PDO::PARAM_STR);
			$stmt->bindParam(':ncm', 					$ncm,			\PDO::PARAM_STR);
			$stmt->bindParam(':descricao', 				$descricao, 	\PDO::PARAM_STR);
			$stmt->bindParam(':piscofins', 				$piscofins,		\PDO::PARAM_STR);
			$stmt->bindParam(':tabela',					$tabela ,						\PDO::PARAM_STR);
			$stmt->bindParam(':descricaooriginalibpt', 	$descricaooriginalibpt,	\PDO::PARAM_STR);
			$stmt->bindParam(':ex', 					$ex,					\PDO::PARAM_STR);
			$stmt->bindParam(':aliqibptnac',			$aliqibptnac,			\PDO::PARAM_STR);
			$stmt->bindParam(':aliqibptimp',			$aliqibptimp ,			\PDO::PARAM_STR);
			$stmt->bindParam(':aliqestadual',			$aliqestadual ,			\PDO::PARAM_STR);
			$stmt->bindParam(':aliqmunicipal',			$aliqmunicipal ,		\PDO::PARAM_STR);
			$stmt->bindParam(':idempresa',  			$idempresa,				\PDO::PARAM_STR);
			$stmt->bindParam(':idcest',  				$idcest,				\PDO::PARAM_STR);
			$stmt->bindParam(':idempresacest',  		$idempresacest,			\PDO::PARAM_STR);

			if($stmt->execute())
			{
				return $idclassfiscal;
			}

		}
		catch(\PDOException $e)
		{
			return $e->getMessage();
		}

	}

	public static function trataDataMYSQL($string)
	{
		$data = str_replace('.', ' ', $string);

		return $data = explode(' ', $data);

		$data = $data[0].'/'.$data[1].'/'.$data[2];

		return $data;
	}

	public static function trataDataHora($string)
	{

		$data = str_replace('.', ' ', $string);
		$data = str_replace('-', ' ', $string);
		$data = str_replace('/', ' ', $string);


		$data = explode(' ', $data);

		if(count($data) >= 3)
		{
			$data = $data[0].'/'.$data[1].'/'.$data[2];
		}
		else
		{
			$data = implode('/', $data);
		}

		return $data;
	}
}