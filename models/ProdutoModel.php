<?php

namespace Model;

use Model\VO\ProdutoVO;
use Model\Database;

// Classe ProdutoModel que gerencia as operações no banco de dados para produtos
final class ProdutoModel extends Model {
    
    // Método para buscar todos os produtos
    public function selectAll($vo) {
        $db = new Database(); // Cria uma conexão com o banco de dados
        $query = "SELECT * FROM produtos"; // Define a consulta SQL
        $data = $db->select($query); // Executa a consulta e obtém os dados
        $arrayLista = []; // Lista para armazenar os produtos

        // Converte os resultados em objetos ProdutoVO
        foreach ($data as $row) {
            $vo = new ProdutoVO($row['id'], $row['id_categoria'], $row['nome'], $row['descricao'], $row['preco'], $row['foto']);
            array_push($arrayLista, $vo);
        }

        return $arrayLista; // Retorna a lista de produtos
    }

    // Método para buscar um único produto pelo ID
    public function selectOne($vo) {
        $db = new Database();
        $query = "SELECT * FROM produtos WHERE id = :id"; // Consulta SQL com parâmetro
        $binds = [
            ":id" => $vo->getId() // Define o valor do parâmetro ID
        ];
        $data = $db->select($query, $binds); // Executa a consulta

        // Retorna um objeto ProdutoVO com os dados do produto encontrado
        return new ProdutoVO($data[0]['id'], $data[0]['nome'], $data[0]['id_categoria'], $data[0]['descricao'], $data[0]['preco'], $data[0]['foto']);
    }

    // Método para inserir um novo produto no banco de dados
    public function insert($vo) {
        $db = new Database();
        $query = "INSERT INTO produtos (nome, id_categoria, descricao, preco, foto) VALUES (:nome, :id_categoria, :descricao, :preco, :foto)"; // Consulta SQL de inserção
        $binds = [
            ":nome" => $vo->getNome(),
            ":id_categoria" => $vo->getIdCategoria(),
            ":descricao" => $vo->getDescricao(),
            ":preco" => $vo->getPreco(),
            ":foto" => $vo->getFoto()
        ];

        return $db->execute($query, $binds); // Executa a inserção e retorna o resultado
    }

    // Método para atualizar um produto existente
    public function update($vo) {
        $db = new Database();
        $query = "UPDATE produtos SET nome = :nome, id_categoria = :id_categoria, descricao = :descricao, preco = :preco, foto = :foto WHERE id = :id"; // Consulta SQL de atualização
        $binds = [
            ":id" => $vo->getId(),
            ":nome" => $vo->getNome(),
            ":id_categoria" => $vo->getIdCategoria(),
            ":descricao" => $vo->getDescricao(),
            ":preco" => $vo->getPreco(),
            ":foto" => $vo->getFoto()
        ];

        return $db->execute($query, $binds); // Executa a atualização e retorna o resultado
    }

    // Método para deletar um produto pelo ID
    public function delete($vo) {
        $db = new Database();
        $query = "DELETE FROM produtos WHERE id = :id"; // Consulta SQL de exclusão
        $binds = [":id" => $vo->getId()];

        return $db->execute($query, $binds); // Executa a exclusão e retorna o resultado
    }
}
