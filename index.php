<?php

// faz as requisições
require_once("config.php");
require_once("vendor/autoload.php");

// chama o controller\CategoriaController
$controller = new Controller\CategoriaController();
// chama a listagem
$controller->list();