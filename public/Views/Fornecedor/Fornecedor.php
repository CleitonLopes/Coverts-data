<?php

require '../../../vendor/autoload.php';

use APP\Controllers\Database\ControllerFornecedor as ControllerFornecedorDB;
use APP\Map\REFRIMAR\MapFornecedor;
use APP\Controllers\Bwps\ControllerFornecedor;

class Fornecedor
{
	private $fornecedorDB;
	private $map;
	private $fornecedor;

	public function __construct()
	{
		$this->fornecedorDB 	= new ControllerFornecedorDB();
		$this->map 				= new MapFornecedor();
		$this->fornecedor 		= new ControllerFornecedor();
	}

	public function convert()
	{
		$dadosFornecedorDB 	= $this->fornecedorDB->listar();
		$dadosMap 			= $this->map->trataDados($dadosFornecedorDB->data, 21);
		$dadosFornecedor 	= $this->fornecedor->create($dadosMap, true);

		if ($dadosFornecedor->retorno == "OK")
		{
			echo json_encode($dadosFornecedor->retorno);
		}
		else
		{
			echo $dadosFornecedor;
		}
	}
}

$fornecedor = new Fornecedor();
$fornecedor->convert();