<?php

namespace APP\Controllers\Database;

use APP\Services\ServiceProduto;

class ControllerProduto
{
	private $serviceProduto;

	public function __construct()
	{
		$this->serviceProduto = new ServiceProduto();
	}

	public function listarLinha()
	{
		try
		{
			return $this->serviceProduto->listarLinha();
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
	}

	public function listarGrupo()
	{
		try
		{
			return $this->serviceProduto->listarGrupo();
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
	}

	public function listarSubGrupo()
	{
		try
		{
			return $this->serviceProduto->listarSubGrupo();
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
	}

	public function listarProduto()
	{
		try
		{
			return $this->serviceProduto->listarProduto();
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
	}
}