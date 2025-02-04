<?php

namespace Model;

use \PDO;

// Classe Database para gerenciar a conexão e operações no banco de dados
final class Database {

    private $connection; // Propriedade que armazena a conexão com o banco

    // Construtor: inicializa a conexão com o banco de dados usando PDO
    public function __construct() {
        $this->connection = new PDO("mysql:host=" . HOST . ";dbname=" . BASE, USER, PASS);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Define o modo de erro como exceção
    }

    // Método para realizar consultas SELECT no banco de dados
    public function select($query, $binds = []) {
        $stmt = $this->connection->prepare($query); // Prepara a consulta SQL

        // Associa os valores aos placeholders da consulta
        foreach($binds as $i => $bind) {
            $stmt->bindValue($i, $bind);
        }

        $stmt->execute(); // Executa a consulta

        return $stmt->fetchAll(); // Retorna os resultados da consulta
    }

    // Método para executar comandos como INSERT, UPDATE e DELETE
    public function execute($query, $binds = []) {
        $stmt = $this->connection->prepare($query); // Prepara a consulta SQL

        // Associa os valores aos placeholders da consulta
        foreach($binds as $i => $bind) {
            $stmt->bindValue($i, $bind);
        }

        return $stmt->execute(); // Executa a consulta e retorna true/false
    }

    // Método para obter o ID do último registro inserido no banco
    public function getLastInsertedId() {
        return $this->connection->lastInsertId();
    }

    // Destrutor: fecha a conexão com o banco de dados quando o objeto for destruído
    public function __destruct() {
        $this->connection = null;
    }
}
