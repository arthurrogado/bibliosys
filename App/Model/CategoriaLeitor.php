<?php

// CategoriaLeitor.php

require_once './App/Model/BaseModel.php';

class CategoriaLeitor extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    public static function getAll() {
        $sql = 'SELECT * FROM categorias_leitor';
        $query = self::$conn->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public static function getCategoriaLeitor($id) {
        $sql = 'SELECT * FROM categorias_leitor WHERE id = :id';
        $query = self::$conn->prepare($sql);
        $query->bindValue(':id', $id);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public static function createCategoriaLeitor($nome, $dias_emprestimo) {
        $sql = 'INSERT INTO categorias_leitor (nome, dias_emprestimo) VALUES (:nome, :dias_emprestimo)';
        $query = self::$conn->prepare($sql);
        $query->bindValue(':nome', $nome);
        $query->bindValue(':dias_emprestimo', $dias_emprestimo);
        return $query->execute();
    }

    public static function updateCategoriaLeitor($id, $nome, $dias_emprestimo) {
        $sql = 'UPDATE categorias_leitor SET nome = :nome, dias_emprestimo = :dias_emprestimo WHERE id = :id';
        $query = self::$conn->prepare($sql);
        $query->bindValue(':id', $id);
        $query->bindValue(':nome', $nome);
        $query->bindValue(':dias_emprestimo', $dias_emprestimo);
        return $query->execute();
    }

    public static function deleteCategoriaLeitor($id) {
        $sql = 'DELETE FROM categorias_leitor WHERE id = :id';
        $query = self::$conn->prepare($sql);
        $query->bindValue(':id', $id);
        return $query->execute();
    }



}