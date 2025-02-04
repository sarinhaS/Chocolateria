<?php

namespace Controller;

abstract class Controller {

    // faz com que o login seja feito de forma obrigatória, então toda vez que for executado o controller, será
    // filtrado se há login.
    public function __construct($obrigaLogin = true){
        session_start();

        if($obrigaLogin){
            // se não está definido um usuário em uma sessão;
            if(!isset($_SESSION["usuario"])){
                $this->redirect("login.php");
                exit;
            }
        }
    }

    // função para facilitar redirecionamentos;
    public function redirect($url) {
        header("Location: " . $url);
        //ex. $controller->redirect("index.php");
    }

    // redirecionamento para carregar uma view;
    public function loadView($view, $data = []) {
        extract($data);
        include("views/" . $view . ".php");
        // ex. $controller->loadView("listaCategoria");
    }

    public function uploadFile($file) {
        // verifica se a imagem está vazia
        if(empty($file["name"])) {
            return "";
        }

        // pega a extensao da img
        $extension = pathinfo($file["name"], PATHINFO_EXTENSION);
        // diz q o nome do arquivo é algo aletorio e junta com a extensao
        $nomeArquivo = uniqid() . "." . $extension;
        // move para a pasta de uploads
        move_uploaded_file($file["tmp_name"], "uploads/" . $nomeArquivo);

        return $nomeArquivo; 
    }

}