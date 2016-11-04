<?php

namespace APP\Services;

use APP\Containers\ServiceContainerDB;
use APP\Containers\ServiceContainer;

class ServiceProduto
{
	private $container;
	private $containerBWPS;

	public function __construct()
	{
		$this->container = new ServiceContainerDB();
		$this->containerBWPS = new ServiceContainer();
	}

	public function listarLinha()
	{
		try
		{
			$container = $this->container->container();
			$linha = $container['produto'];

			return $linha->listarLinha();
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
	}

	public function createLinha($data, $increment)
	{
		try
		{
			$container = $this->containerBWPS->container();
			$linha = $container['produto'];

			return $linha->createLinha($data, $increment);
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
			$container = $this->container->container();
			$grupo = $container['produto'];

			return $grupo->listarGrupo();
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
			$container = $this->containerBWPS->container();
			$linha = $container['produto'];

			return $linha->createGrupo($data, $increment);
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
			$container = $this->container->container();
			$subGrupo = $container['produto'];

			return $subGrupo->listarSubGrupo();
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
			$container = $this->containerBWPS->container();
			$linha = $container['produto'];

			return $linha->createSubGrupo($data, $increment);
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
			$container = $this->container->container();
			$subGrupo = $container['produto'];

			return $subGrupo->listarProduto();
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
	}

	public function createProduto($data, $increment)
	{
		try
		{
			$container = $this->containerBWPS->container();
			$linha = $container['produto'];

			return $linha->createProduto($data, $increment);
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
	}

}