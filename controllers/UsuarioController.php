<?php

namespace Controller;

use Model\UsuarioModel;
use Model\VO\UsuarioVO;

// Define a classe UsuarioController que herda de Controller e não pode ser estendida (final).
final class UsuarioController extends Controller {

    // Construtor da classe
    public function __construct() {
        parent::__construct(); // Chama o construtor da classe pai

        // Verifica se o usuário logado tem nível 2, e se tiver, redireciona para a página inicial.
        if ($_SESSION["usuario"]->getNivel() == 2) {
            $this->redirect("index.php");
            exit;
        }
    }

    // Método para listar todos os usuários
    public function list() {
        $model = new UsuarioModel(); // Instancia o modelo de usuário
        $data = $model->selectAll(new UsuarioVO()); // Busca todos os usuários

        // Carrega a view de listagem de usuários, passando os dados encontrados
        $this->loadView("listaUsuarios", [
            "usuarios" => $data
        ]);
    }

    // Método para exibir o formulário de cadastro/edição de usuário
    public function form() {
        $id = $_GET['id'] ?? 0; // Obtém o ID do usuário (se existir)

        if (empty($id)) { // se não tiver; se estiver vazio;
            $vo = new UsuarioVO(); // Cria um objeto vazio para um novo usuário
        } else {
            $model = new UsuarioModel();
            $vo = $model->selectOne(new UsuarioVO($id)); // Busca um usuário específico pelo ID
        }

        // Carrega a view do formulário, passando os dados do usuário
        $this->loadView("formUsuario", [
            "usuario" => $vo
        ]);
    }

    // Método para salvar um novo usuário ou atualizar um existente
    public function save() {
        $id = $_POST["id"]; // Obtém o ID do formulário

        $model = new UsuarioModel();

        // Cria um objeto de usuário com os dados do formulário
        $vo = new UsuarioVO($id, $_POST["login"], $_POST["senha"], $_POST["nivel"]);

        if (empty($id)) {
            $result = $model->insert($vo); // Insere um novo usuário
        } else {
            $result = $model->update($vo); // Atualiza um usuário existente
        }

        // Redireciona para a página de usuários após salvar
        $this->redirect("usuarios.php");
    }

    // Método para remover um usuário
    public function remove() {
        $model = new UsuarioModel();
        $model->delete(new UsuarioVO($_GET["id"])); // Deleta o usuário pelo ID recebido
        $this->redirect("usuarios.php"); // Redireciona para a lista de usuários
    }
}
