<?php

namespace Controller;

use Model\UsuarioModel;
use Model\VO\UsuarioVO;

final class CadastroController  extends Controller {

    public function __construct(){
        parent::__construct(false);
    }

    //carrega a view cadastro
    public function cadastro(){
        $this->loadView("cadastro");
    }

    public function fazerCadastro(){
        //cria novo usuario
        if($_POST["senha"] === $_POST['confirmasenha']){
            $vo = new UsuarioVO(null, $_POST["login"], $_POST["senha"], $_POST['confirmasenha']);
            $model = new UsuarioModel();

            //salva os dados enviados
            $result = $model->doCadastro($vo);

            //se está vazio, retorna para a página de login até preencher
            if(empty($result)){
                $this->redirect("cadastro.php");
                //se preenchido, irá redirecionar para o index
            }else{
                $this->redirect("index.php");
            }
        }else{
            $this->loadView("cadastro");
        }

    }
}