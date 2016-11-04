<?php

namespace APP\Controllers\Bwps;

use APP\Services\ServiceProduto;

class ControllerProduto
{
	private $serviceProduto;

	public function __construct()
	{
		$this->serviceProduto = new ServiceProduto();
	}

	public function createLinha($data, $increment)
	{

		try
		{
			return $this->serviceProduto->createLinha($data, $increment);
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
	}

	public function createGrupo($data, $increment)
	{

		try
		{
			return $this->serviceProduto->createGrupo($data, $increment);
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
	}

	public function createSubGrupo($data, $increment)
	{

		try
		{
			return $this->serviceProduto->createSubGrupo($data, $increment);
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
	}

	public function create($data, $increment)
	{

		try
		{
			return $this->serviceProduto->createProduto($data, $increment);
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
	}
}