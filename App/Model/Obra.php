<?php

// Obra.php

require_once './App/Model/BaseModel.php';


class Obra extends BaseModel {
    private $id;
    private $nome;
    private $descricao;

    public function __construct() {
        parent::__construct();
    }

    public function setId($id) {
        $this->id = $id;
    }

    public static function getObra($id) {
        $sql = 'SELECT * FROM obras WHERE id = :id';
        $query = self::$conn->prepare($sql);
        $query->bindValue(':id', $id);
        try {
            $query->execute();
            return $query->fetch(PDO::FETCH_OBJ);
        } catch (\Throwable $th) {
            return false;
        }
    }

    // Criar obra
    public static function criarObra($nome, $descricao) {
        $sql = 'INSERT INTO obras (nome, descricao) VALUES (:nome, :descricao)';
        $query = self::$conn->prepare($sql);
        $query->bindValue(':nome', $nome);
        $query->bindValue(':descricao', $descricao);
        return $query->execute();
    }

    // Listar obras
    public static function listarObras() {
        $sql = 'SELECT * FROM obras';
        $query = self::$conn->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getColaboradores() {
        $sql = 'SELECT * FROM colaboradores WHERE id IN (SELECT id_colaborador FROM colaboradores_obras WHERE id_obra = :id_obra)';
        $query = self::$conn->prepare($sql);
        $query->bindValue(':id_obra', $this->id);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

}