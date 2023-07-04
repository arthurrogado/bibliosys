<?php

// CategoriaLiteraria.php

require_once './App/Model/BaseModel.php';

class CategoriaLiteraria extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    public static function getAll() {
        $sql = 'SELECT * FROM categorias_literarias';
        $query = self::$conn->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public static function getCategoriaLiteraria($id) {
        $sql = 'SELECT * FROM categorias_literarias WHERE id = :id';
        $query = self::$conn->prepare($sql);
        $query->bindValue(':id', $id);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public static function createCategoriaLiteraria($nome, $dias_emprestimo, $multa_diaria) {
        $sql = 'INSERT INTO categorias_literarias (nome, dias_emprestimo, multa_diaria) VALUES (:nome, :dias_emprestimo, :multa_diaria)';
        $query = self::$conn->prepare($sql);
        $query->bindValue(':nome', $nome);
        $query->bindValue(':multa_diaria', $multa_diaria);
        $query->bindValue(':dias_emprestimo', $dias_emprestimo);
        return $query->execute();
    }

    public static function updateCategoriaLiteraria($id, $nome, $dias_emprestimo, $multa_diaria) {
        $sql = 'UPDATE categorias_literarias SET nome = :nome, dias_emprestimo = :dias_emprestimo, multa_diaria = :multa_diaria WHERE id = :id';
        $query = self::$conn->prepare($sql);
        $query->bindValue(':id', $id);
        $query->bindValue(':nome', $nome);
        $query->bindValue(':dias_emprestimo', $dias_emprestimo);
        $query->bindValue(':multa_diaria', $multa_diaria);
        return $query->execute();
    }

    public static function deleteCategoriaLiteraria($id) {
        $sql = 'DELETE FROM categorias_literarias WHERE id = :id';
        $query = self::$conn->prepare($sql);
        $query->bindValue(':id', $id);
        return $query->execute();
    }



}