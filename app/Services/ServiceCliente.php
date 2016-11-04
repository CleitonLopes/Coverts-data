<?php

namespace APP\Services;

use APP\Containers\ServiceContainerDB;
use APP\Containers\ServiceContainer;

class ServiceCliente
{
	private $container;
	private $containerBWPS;

	public function __construct()
	{
		$this->container = new ServiceContainerDB();
		$this->containerBWPS = new ServiceContainer();
	}

	public function listarClientes()
	{
		try
		{
			$cliente = $this->container->container();
			$cliente = $cliente['cliente'];

			return $resultado = $cliente->listarClientes();

		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}

		return $resultado;
	}

	public function create($data, $increment)
	{
		try
		{
			$cliente = $this->containerBWPS->container();
			$cliente = $cliente['cliente'];

			return $resultado = $cliente->create($data, $increment);
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
	}
}