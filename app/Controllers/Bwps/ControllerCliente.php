<?php

namespace APP\Controllers\Bwps;

use APP\Services\ServiceCliente;


class ControllerCliente
{
	private $serviceCliente;

	public function __construct()
	{
		$this->serviceCliente = new ServiceCliente();
	}

	public function create($data, $increment)
	{
		try
		{
			return $this->serviceCliente->create($data, $increment);
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}

		return $resultado;
	}
}





