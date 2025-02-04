<?php

namespace Model;

use Model\VO\CategoriaVO;
use Model\Database;

// Define a classe CategoriaModel que gerencia operações no banco de dados para categorias
final class CategoriaModel extends Model {

    // Método para buscar todas as categorias do banco de dados
    public function selectAll($vo) {
        $db = new Database(); // Instancia a conexão com o banco de dados
        $query = "SELECT * FROM categorias"; // Define a consulta SQL
        $data = $db->select($query); // Executa a consulta e obtém os dados

        $arrayLista = []; // Cria um array para armazenar os objetos CategoriaVO

        // Converte os resultados do banco em objetos CategoriaVO
        foreach ($data as $row) {
            $vo = new CategoriaVO($row['id'], $row['nome']);
            array_push($arrayLista, $vo);
        }

        return $arrayLista; // Retorna a lista de categorias
    }

    // Método para buscar uma única categoria pelo ID
    public function selectOne($vo) {
        $db = new Database();
        $query = "SELECT * FROM categorias WHERE id = :id"; // Consulta SQL com parâmetro
        $binds = [
            ":id" => $vo->getId() // Define o valor do parâmetro ID
        ];
        $data = $db->select($query, $binds); // Executa a consulta com o parâmetro

        // Retorna um objeto CategoriaVO com os dados da categoria encontrada
        return new CategoriaVO($data[0]['id'], $data[0]['nome']);  
    }

    // Método para inserir uma nova categoria no banco de dados
    public function insert($vo) {
        $db = new Database();
        $query = "INSERT INTO categorias (nome) VALUES (:nome)"; // Consulta SQL de inserção
        $binds = [
            ":nome" => $vo->getNome() // Define o valor do parâmetro nome
        ];

        return $db->execute($query, $binds); // Executa a inserção e retorna o resultado
    }

    // Método para atualizar uma categoria existente
    public function update($vo) {
        $db = new Database();
        $query = "UPDATE categorias SET nome = :nome WHERE id = :id"; // Consulta SQL de atualização
        $binds = [
            ":id" => $vo->getId(),
            ":nome" => $vo->getNome()
        ];

        return $db->execute($query, $binds); // Executa a atualização e retorna o resultado
    }

    // Método para deletar uma categoria pelo ID
    public function delete($vo) {
        $db = new Database();
        $query = "DELETE FROM categorias WHERE id = :id"; // Consulta SQL de exclusão
        $binds = [":id" => $vo->getId()];

        return $db->execute($query, $binds); // Executa a exclusão e retorna o resultado
    }
}
