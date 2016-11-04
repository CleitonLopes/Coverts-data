<?php

require '../../../vendor/autoload.php';

use APP\Controllers\Database\ControllerCliente as ControllerClienteDB;
use APP\Map\REFRIMAR\MapCliente;
use APP\Controllers\Bwps\ControllerCliente;

class Cliente
{
	private $clienteDB;
	private $map;
	private $cliente;

	public function __construct()
	{
		$this->clienteDB = new ControllerClienteDB;
		$this->map = new MapCliente;
		$this->cliente = new ControllerCliente;
	}

	public function convert()
	{
		$dadosClienteDB = $this->clienteDB->listar();
		$dadosMap = $this->map->trataDados($dadosClienteDB->data, 21);
		$dadosCliente = $this->cliente->create($dadosMap, true);

		if($dadosCliente->retorno == "OK")
		{
			echo json_encode("OK");
		}
		else
		{
			echo json_encode($dadosCliente->retorno);
		}
	}
}

$cliente = new Cliente();
$cliente->convert();