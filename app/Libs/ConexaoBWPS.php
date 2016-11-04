<?php

namespace APP\Libs;

use APP\Interfaces\ConexaoInterface;

class ConexaoBWPS implements ConexaoInterface
{

	private $host;
	private $user;
	private $dbname;
	private $pass;
	private static $db;


	public function __construct($host, $db, $user, $pass)
	{
		$this->host 	= $host;
		$this->dbname 	= $db;
		$this->user 	= $user;
		$this->pass 	= $pass;
	}


	public function connect()
	{
		try
		{
			if(!self::$db)
			{
				self::$db = new \PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->user, $this->pass);
				self::$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
				self::$db->exec('SET NAMES utf8');
			}

			return self::$db;

		}
		catch(PDOException $e)
		{
			throw new Exception("Erro ao tentar se conectar em {$this->host} - {$this->dbname}, {$e->getMessage()}");
		}

	}

}

