<?php

namespace Model;

use Model\Vo\UsuarioVO;
use Model\Database;

// Classe UsuarioModel que gerencia as operações no banco de dados para usuários
final class UsuarioModel extends Model {

    // Método para buscar todos os usuários
    public function selectAll($vo){
        $db = new Database(); // Conecta ao banco de dados
        $query = "SELECT * FROM usuarios"; // Define a consulta SQL
        $data = $db->select($query); // Executa a consulta e obtém os dados
        $arrayLista = []; // Lista para armazenar os usuários

        // Converte os resultados em objetos UsuarioVO
        foreach($data as $row){
            $vo = new UsuarioVO($row['id'], $row['login'], $row['senha'], $row['nivel']);
            array_push($arrayLista, $vo);
        }

        return $arrayLista; // Retorna a lista de usuários
    }

    // Método para buscar um único usuário pelo ID
    public function selectOne($vo){
        $db = new Database();
        $query = "SELECT * FROM usuarios WHERE id = :id"; // Consulta SQL com parâmetro
        $binds = [
            ":id" => $vo->getId() // Define o valor do parâmetro ID
        ];
        $data = $db->select($query, $binds); // Executa a consulta

        // Retorna um objeto UsuarioVO com os dados do usuário encontrado
        return new UsuarioVO($data[0]['id'], $data[0]['login'], $data[0]['senha'], $data[0]['nivel']);  
    }

    // Método para inserir um novo usuário no banco de dados
    public function insert($vo){
        $db = new Database();
        $query = "INSERT INTO usuarios (login, senha, nivel) VALUES (:login, :senha, :nivel)"; // Consulta SQL de inserção
        $binds = [
            ":login" => $vo->getLogin(),
            ":senha" => md5($vo->getSenha()), // Criptografa a senha com MD5
            ":nivel" => $vo->getNivel()
        ];

        return $db->execute($query, $binds); // Executa a inserção e retorna o resultado
    }

    // Método para atualizar os dados de um usuário
    public function update($vo){
        $db = new Database();

        // Se a senha estiver vazia, não altera a senha do usuário
        if(empty($vo->getSenha())){
            $query = "UPDATE usuarios SET login=:login, nivel=:nivel WHERE id=:id";
            $binds = [
                ":id" => $vo->getId(),
                ":login" => $vo->getLogin(),
                ":nivel" => $vo->getNivel()
            ];
        } else { 
            // Se houver nova senha, atualiza também a senha do usuário
            $query = "UPDATE usuarios SET login=:login, senha=:senha, nivel=:nivel WHERE id=:id";
            $binds = [
                ":id" => $vo->getId(),
                ":login" => $vo->getLogin(),
                ":senha" => md5($vo->getSenha()), // Criptografa a nova senha
                ":nivel" => $vo->getNivel()
            ];
        }

        return $db->execute($query, $binds); // Executa a atualização e retorna o resultado
    }

    // Método para deletar um usuário pelo ID
    public function delete($vo){
        $db = new Database();
        $query = "DELETE FROM usuarios WHERE id = :id"; // Consulta SQL de exclusão
        $binds = [":id" => $vo->getId()];

        return $db->execute($query, $binds); // Executa a exclusão e retorna o resultado
    }

    // Método para autenticar um usuário no sistema (login)
    public function doLogin($vo){
        $db = new Database();
        $query = "SELECT * FROM usuarios WHERE login = :login AND senha=:senha"; // Consulta SQL para verificar login e senha
        $binds = [
            ":login" => $vo->getLogin(),
            ":senha" => md5($vo->getSenha()) // Compara a senha criptografada
        ];

        $data = $db->select($query, $binds); // Executa a consulta

        // Se não encontrar nenhum usuário, retorna nulo
        if(count($data) == 0){
            return null;
        }

        // Inicia uma sessão e armazena os dados do usuário autenticado
        session_start();
        $_SESSION["usuario"] = new UsuarioVO($data[0]["id"], $data[0]["login"], $data[0]["senha"], $data[0]["nivel"]);

        return $_SESSION["usuario"]; // Retorna o usuário autenticado
    }
}
