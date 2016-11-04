<?php

namespace APP\Containers;

use APP\Libs\ConexaoDB;
use APP\Libs\DadosConexao;
use APP\Models\Database\Cliente;
use APP\Models\Database\Fornecedor;
use APP\Models\Database\Produto;
use Pimple\Container;


/**

	TODO:
	- Classe com containers de serviços já com a instancia da conexao
	- Retorno: containers com a conexao do banco a ser convertido

 */

class ServiceContainerDB
{
	private $container;

	public function __construct()
	{
		$this->container = new Container();
	}


	public function container()
	{

		$this->container['conexaoDB'] = function($c)
		{
			return new ConexaoDB(DadosConexao::$HOST, DadosConexao::$DB, DadosConexao::$USER, DadosConexao::$PASS);
		};

		$this->container['cliente'] = function($c)
		{
			return new Cliente($c['conexaoDB']);
		};

		$this->container['fornecedor'] = function($c)
		{
			return new Fornecedor($c['conexaoDB']);
		};

		$this->container['produto'] = function($c)
		{
			return new Produto($c['conexaoDB']);
		};

		return $this->container;
	}
}
