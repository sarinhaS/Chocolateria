<?php

namespace Controller;

use Model\CategoriaModel;
use Model\VO\CategoriaVO;

final class CategoriaController extends Controller {

    // requisita a função do parent::controller
    public function __construct(){
        parent::__construct();
    }

    // função para a listagem 
    public function list() {
        // criar uma instância com a categoriamodel, que é a que faz interação com o bd (usado para manipulações)
        $model = new CategoriaModel();
        // seleciona todos da $model (faz instância com o vo, representando uma categoria especifica)
        $data = $model->selectAll(new CategoriaVO());

        // carrega a view e envia o valor recebido;
        $this->loadView("listaCategoria", [
            "categorias" => $data,
        ]);
    }

    public function form() {
        // se há id, tera o valor do mesmo, se não será 0
        $id = $_GET['id'] ?? 0;

        // se o id está vazio, será criado uma nova categoria;
        if(empty($id)) {
            $vo = new CategoriaVO();
            //se não, irá selecionar uma (para editar)
        } else {
            $model = new CategoriaModel();
            $vo = $model->selectOne(new CategoriaVO($id));
        }

        // carrega a view
        $this->loadView("formCategoria", [
            "categoria" => $vo
        ]);
    }

    public function save(){
        // pega o id
        $id = $_POST["id"];


        // guarda os dados
        $model = new CategoriaModel();
        $vo = new CategoriaVO($id, $_POST["nome"], $_POST["descricao"]);

        //se está vazio o id, irá inserir uma nova categoria
        if(empty($id)){
            $result = $model->insert($vo);
            //se não, irá atualizar os novos dados (alteração)
        } else {
            $result = $model->update($vo);
        }
        
        //redireciona de volta para o index
        $this->redirect("index.php");
    }

    //remoção
    public function remove(){
        $model = new CategoriaModel();
        $model->delete(new CategoriaVO($_GET["id"]));
        $this->redirect("index.php");
    }

}
