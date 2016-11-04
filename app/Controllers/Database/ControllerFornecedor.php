<?php

namespace APP\Controllers\Database;

use APP\Services\ServiceFornecedor;


class ControllerFornecedor
{
	private $serviceFornecedor;

	public function __construct()
	{
		$this->serviceFornecedor = new ServiceFornecedor();
	}

	public function listar()
	{
		try
		{
			return $this->serviceFornecedor->listar();
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
	}
}