<?php

// Colaborador.php

require_once './App/Model/BaseModel.php';


class Colaborador extends BaseModel {
    // id, nome, cpf, telefone, endereco, diaria, funcao, observacoes
    private $id;
    private $nome;
    private $cpf;
    private $telefone;
    private $endereco;
    private $diaria;
    private $funcao;
    private $observacoes;

    public function __construct() {
        parent::__construct();
    }

    // Criar colaborador
    public static function criarColaborador($nome, $cpf, $telefone, $endereco, $diaria, $funcao, $observacoes) {
        $sql = 'INSERT INTO colaboradores (nome, cpf, telefone, endereco, diaria, funcao, observacoes) VALUES (:nome, :cpf, :telefone, :endereco, :diaria, :funcao, :observacoes)';
        $query = self::$conn->prepare($sql);
        $query->bindValue(':nome', $nome);
        $query->bindValue(':cpf', $cpf);
        $query->bindValue(':telefone', $telefone);
        $query->bindValue(':endereco', $endereco);
        $query->bindValue(':diaria', $diaria);
        $query->bindValue(':funcao', $funcao);
        $query->bindValue(':observacoes', $observacoes);
        try {
            //code...
            return $query->execute();
        } catch (\Throwable $th) {
            //throw $th;
            return false;
        }
    }

    public static function getAll() {
        $sql = 'SELECT * FROM colaboradores';
        $query = self::$conn->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public static function vincular($colaborador_id, $obra_id) {
        $sql = 'INSERT INTO colaboradores_obras (colaborador_id, obra_id) VALUES (:colaborador_id, :obra_id)';
        $query = self::$conn->prepare($sql);
        $query->bindValue(':colaborador_id', $colaborador_id);
        $query->bindValue(':obra_id', $obra_id);
        return $query->execute();
    }

    public static function getNaoVinculado($id_obra) {
        $sql = 'SELECT * FROM colaboradores WHERE id NOT IN (SELECT id_colaborador FROM colaboradores_obras WHERE id_obra = :id_obra)';
        $query = self::$conn->prepare($sql);
        $query->bindValue(':id_obra', $id_obra);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public static function vincularAObra($id_colaborador, $id_obra) {
        // check if already exists
        $sql = 'SELECT * FROM colaboradores_obras WHERE id_colaborador = :id_colaborador AND id_obra = :id_obra';
        $query = self::$conn->prepare($sql);
        $query->bindValue(':id_colaborador', $id_colaborador);
        $query->bindValue(':id_obra', $id_obra);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        if (count($result) > 0) {
            return false;
        }
        // insert
        $sql = 'INSERT INTO colaboradores_obras (id_colaborador, id_obra) VALUES (:id_colaborador, :id_obra)';
        $query = self::$conn->prepare($sql);
        $query->bindValue(':id_colaborador', $id_colaborador);
        $query->bindValue(':id_obra', $id_obra);
        return $query->execute();
    }

}

?>