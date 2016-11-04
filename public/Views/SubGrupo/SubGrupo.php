<?php

require '../../../vendor/autoload.php';

use APP\Controllers\Database\ControllerProduto as ControllerProdutoDB;
use APP\Map\REFRIMAR\MapProduto;
use APP\Controllers\Bwps\ControllerProduto;


class SubGrupo
{
	private $subGrupoDB;
	private $map;
	private $subGrupo;

	public function __construct()
	{
		$this->subGrupoDB 	= new ControllerProdutoDB();
		$this->map 			= new MapProduto();
		$this->subGrupo 	= new ControllerProduto();
	}

	public function convert()
	{
		$dadosSubGrupoDB 	= $this->subGrupoDB->listarSubGrupo();
		$dadosMap 			= $this->map->trataSubGrupo($dadosSubGrupoDB->data, 21);
		$dadosSubGrupo 		= $this->subGrupo->createSubGrupo($dadosMap, false);

		if($dadosSubGrupo->retorno == "OK")
		{
			echo json_encode("OK");
		}
	}
}

$subGrupo = new SubGrupo();
$subGrupoDB->convert();
