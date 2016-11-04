<?php

namespace APP\Services;

use APP\Containers\ServiceContainerDB;
use APP\Containers\ServiceContainer;

class ServiceFornecedor
{
	private $containerDB;
	private $containerBWPS;

	public function __construct()
	{
		$this->containerDB = new ServiceContainerDB();
		$this->containerBWPS = new ServiceContainer();
	}

	public function listar()
	{
		try
		{
			$fornecedor = $this->containerDB->container();
			$fornecedor = $fornecedor['fornecedor'];

			return $resultado = $fornecedor->listar();

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
			$fornecedor = $this->containerBWPS->container();
			$fornecedor = $fornecedor['fornecedor'];

			return $resultado = $fornecedor->create($data, $increment);
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
	}
}