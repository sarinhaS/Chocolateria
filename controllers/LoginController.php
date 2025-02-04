<?php

namespace Controller;

use Model\UsuarioModel;
use Model\VO\UsuarioVO;

final class LoginController  extends Controller {

    public function __construct(){
        parent::__construct(false);
    }

    //carrega a view login
    public function login(){
        $this->loadView("login");
    }

    public function fazerLogin(){
        //cria novo usuario
        $vo = new UsuarioVO(0, $_POST["login"], $_POST["senha"]);
        $model = new UsuarioModel();

        //salva os dados enviados
        $result = $model->doLogin($vo);

        //se está vazio, retorna para a página de login até preencher
        if(empty($result)){
            $this->redirect("login.php");
            //se preenchido, irá redirecionar para o index
        }else{
            $this->redirect("index.php");
        }

    }

    //deslogar
    public function logout(){
        session_destroy();
        $this->redirect("login.php");
    }

}