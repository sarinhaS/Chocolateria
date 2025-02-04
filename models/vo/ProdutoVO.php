<?php

namespace Model\VO;

class ProdutoVO {
    private $id;
    private $idCategoria;
    private $nome;
    private $descricao;
    private $preco;
    private $foto;

    public function __construct($id = null, $idCategoria = null, $nome = '', $descricao = '', $preco = 0.0, $foto = '') {
        $this->id = $id;
        $this->idCategoria = $idCategoria;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->preco = $preco;
        $this->foto = $foto;
    }

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }
    public function getIdCategoria() { return $this->idCategoria; }
    public function setIdCategoria($idCategoria) { $this->idCategoria = $idCategoria; }
    public function getNome() { return $this->nome; }
    public function setNome($nome) { $this->nome = $nome; }
    public function getDescricao() { return $this->descricao; }
    public function setDescricao($descricao) { $this->descricao = $descricao; }
    public function getPreco() { return $this->preco; }
    public function setPreco($preco) { $this->preco = $preco; }
    public function getFoto() { return $this->foto; }
    public function setFoto($foto) { $this->foto = $foto; }
}
