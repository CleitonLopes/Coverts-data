<?php

require '../../../vendor/autoload.php';

use APP\Controllers\Database\ControllerProduto as ControllerProdutoDB;
use APP\Map\REFRIMAR\MapProduto;
use APP\Controllers\Bwps\ControllerProduto;


class Linha
{
	private $linhaDB;
	private $map;
	private $linha;

	public function __construct()
	{
		$this->linhaDB 	= new ControllerProdutoDB();
		$this->map 		= new MapProduto();
		$this->linha 	= new ControllerProduto();
	}

	public function convert()
	{
		$dadosLinhaDB 	= $this->linhaDB->listarLinha();
		$dadosMap 		= $this->map->trataLinha($dadosLinhaDB->data, 21);
		$dados 			= $this->linha->createLinha($dadosMap, false);

		if($dadosLinha->retorno == "OK")
		{
			echo json_encode($dadosLinha->retorno);
		}
	}
}

$linha = new Linha();
$linha->convert();


