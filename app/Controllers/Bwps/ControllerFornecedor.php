<?php

namespace APP\Controllers\Bwps;

use APP\Services\ServiceFornecedor;

class ControllerFornecedor
{
	private $serviceFornecedor;

	public function __construct()
	{
		$this->serviceFornecedor = new ServiceFornecedor();
	}

	public function create($data, $increment)
	{

		try
		{
			return $this->serviceFornecedor->create($data, $increment);
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
	}
}