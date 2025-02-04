<?php

namespace Model;

// Classe abstrata Model que define a estrutura básica dos modelos
abstract class Model {

    // Método abstrato para buscar todos os registros
    abstract public function selectAll($vo);

    // Método abstrato para buscar um registro específico
    abstract public function selectOne($vo);

    // Método abstrato para inserir um novo registro
    abstract public function insert($vo);

    // Método abstrato para atualizar um registro existente
    abstract public function update($vo);

    // Método abstrato para deletar um registro
    abstract public function delete($vo);

}
