<?php

namespace APP\Containers;

use APP\Libs\ConexaoBWPS;
use APP\Libs\DadosConexao;
use APP\Models\Bwps\Cliente;
use APP\Models\Bwps\Fornecedor;
use APP\Models\Bwps\Produto;
use Pimple\Container;

/**

	TODO:
	- Classe com containers de serviços já com a instancia da conexao
	- Retorno: containers com a conexao do banco a BWPS para conversão

 */

class ServiceContainer
{
	private $container;

	public function __construct()
	{
		$this->container = new Container();
	}


	public function container()
	{

		$this->container['conexaoBWPS'] = function($c)
		{
			return new ConexaoBWPS(DadosConexao::$MYSQLHOST, DadosConexao::$MYSQLDB, DadosConexao::$MYSQLUSER, DadosConexao::$MYSQLPASS);
		};

		$this->container['cliente'] = function($c)
		{
			return new Cliente($c['conexaoBWPS']);
		};

		$this->container['fornecedor'] = function($c)
		{
			return new Fornecedor($c['conexaoBWPS']);
		};

		$this->container['produto'] = function($c)
		{
			return new Produto($c['conexaoBWPS']);
		};

		return $this->container;
	}
}
