<?php

namespace Controller;

use Model\ProdutoModel;
use Model\VO\ProdutoVO;
use Model\CategoriaModel;
use Model\VO\CategoriaVO;

final class ProdutoController extends Controller {

    //listagem
    public function list() {
        // conexão com os produtos
        $model = new ProdutoModel();
        $data = $model->selectAll(new ProdutoVO());

        $modelcat = new CategoriaModel();
        $datacat = $modelcat->selectAll(new CategoriaVO());

        // carrega a view
        $this->loadView("listaProdutos", [
            "produto" => $data,
            "categorias" => $datacat
        ]);
    }

    public function form() {
        //se tiver id, se não 0 
        $id = $_GET["id"] ?? 0;

        //se o id não estiver vazio, irá fazer a ação de alteração
        if(!empty($id)) {
            $model = new ProdutoModel();
            $vo = new ProdutoVO($id);
            $produto = $model->selectOne($vo);
        } else {
            //se não, irá criar um novo
            $produto = new ProdutoVO();
        }

        // Cria uma instância do modelo de Categoria, que gerencia operações no banco de dados.
        $model = new CategoriaModel(); 

        // Cria um objeto VO da categoria, passando o ID como parâmetro.
        // O VO geralmente é uma classe usada para representar dados de forma estruturada.
        $vo = new CategoriaVO($id); 

        // Chama o método selectAll do model, passando o objeto VO como parâmetro.
        // Esse método retorna todas as categorias relacionadas ao VO (por exemplo, categorias com um determinado ID).
        $categoria = $model->selectAll($vo);

        //carrega a view
        $this->loadView("formProduto", [
            "produto" => $produto,
            "categorias" => $categoria
        ]);
    }

    public function save() {
        //recupera os ids
        $id = $_POST["id"];
        $id_categoria = $_POST["id_categoria"];

        $categoriaModel = new CategoriaModel();

        // Gera um novo nome para a foto ao fazer o upload do arquivo.
        $nomeArquivo = $this->uploadFile($_FILES['foto']);

        // Cria um objeto ProdutoVO com os dados do formulário e o nome do arquivo da foto.
        $vo = new ProdutoVO($id, $id_categoria, $_POST["nome"], $_POST["descricao"], $_POST["preco"], $nomeArquivo);

        // Instancia o modelo de Produto, responsável pela comunicação com o banco de dados.
        $model = new ProdutoModel();

        try {
            // Se não houver ID, insere um novo produto; caso contrário, atualiza o existente.
            if (empty($id)) {
                $model->insert($vo);
            } else {
                $model->update($vo);
            }

            // Redireciona para a página de produtos após salvar.
            $this->redirect("produtos.php");
        } catch (\PDOException $e) {
            // Exibe uma mensagem de erro caso ocorra um problema no banco de dados.
            echo "Erro ao salvar: " . $e->getMessage();
        }

    }

    public function remove() {
        // acessa o produto em especifico (pelo id)
        $vo = new ProdutoVO($_GET["id"]);
        $model = new ProdutoModel();

        //deleta o produto especifico 
        $result = $model->delete($vo);

        //redireciona para o produtos.php
        $this->redirect("produtos.php");
    }

}