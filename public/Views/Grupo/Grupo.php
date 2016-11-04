<?php

require '../../../vendor/autoload.php';

use APP\Controllers\Database\ControllerProduto as ControllerProdutoDB;
use APP\Map\REFRIMAR\MapProduto;
use APP\Controllers\Bwps\ControllerProduto;



class Grupo
{

	private $grupoDB;
	private $map;
	private $grupo;

	public function __construct()
	{
		$this->grupoDB 	= new ControllerProdutoDB();
		$this->map 		= new MapProduto();
		$this->grupo 	= new ControllerProduto();
	}

	public function convert()
	{

		$dadosGrupoDB 	= $this->grupoDB->listarGrupo();;
		$dadosMap 		= $this->map->trataGrupo($dadosGrupo->data, 21);
		$dadosGrupo 	= $this->grupo->createGrupo($dadosMap, true);

		if($dadosGrupo->retorno == "OK")
		{
			echo json_encode("OK");
		}
	}
}

$grupo = new Grupo();
$grupo->convert();