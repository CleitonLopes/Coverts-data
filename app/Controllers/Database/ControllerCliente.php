<?php

namespace APP\Controllers\Database;

use APP\Services\ServiceCliente;


class ControllerCliente
{
	private $serviceCliente;

	public function __construct()
	{
		$this->serviceCliente = new ServiceCliente();
	}

	public function listar()
	{
		try
		{
			return $this->serviceCliente->listarClientes();
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
	}
}