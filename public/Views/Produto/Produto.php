<?php

require '../../../vendor/autoload.php';

use APP\Controllers\Database\ControllerProduto as ControllerProdutoDB;
use APP\Map\REFRIMAR\MapProduto;
use APP\Controllers\Bwps\ControllerProduto;


class Produto
{
	private $produtoDB;
	private $map;
	private $produto;

	public function __construct()
	{
		$this->produtoDB 	= new ControllerProdutoDB();
		$this->map 			= new MapProduto();
		$this->produto 		= new ControllerProduto();
	}

	public function convert()
	{
		$dadosProdutoDB = $this->produtoDB->listarProduto();
		$dadosMap 		= $this->map->trataDados($dadosProdutoDB->data, 21);
		$dadosProduto 	= $this->produto->createProduto($dadosMap, false);

		if($dadosProduto->retorno == "OK")
		{
			echo json_encode($dadosProduto->retorno);
		}
	}
}

$produto = new Produto();
$produto->convert();






