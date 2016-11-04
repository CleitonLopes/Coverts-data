<?php

ini_set('display_errors', 1);


// use APP\Controllers\Database\ControllerProduto as ControllerProdutoDB;
// use APP\Map\MapProduto;
// use APP\Controllers\Bwps\ControllerProduto as ControllerProduto;


// $produtoDB = new ControllerProdutoDB();
// $dadosProdDB = $produtoDB->listarProduto();

// $produtoMap = new MapProduto();
// $dadosMap = $produtoMap->trataProduto($dadosProdDB->data, 21);


// $produto = new ControllerProduto();
// $dadosProd = $produto->create($dadosMap, false);

// var_dump($dadosProd);


/*Cliente */

use APP\Controllers\Database\ControllerCliente as ControllerClienteDB;
use APP\Map\LBAUTO\MapCliente;
use APP\Controllers\Bwps\ControllerCliente;

$clienteDB = new ControllerClienteDB();
$dados = $clienteDB->listar();

$clienteMap = new MapCliente();
$dadosClienteMap = $clienteMap->trataDados($dados->data, 20);

$cliente = new ControllerCliente();
$dadosClienteBWPS = $cliente->create($dadosClienteMap, false);

var_dump($dadosClienteBWPS);






