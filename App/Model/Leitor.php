<?php

// Leitor.php

require_once './App/Model/BaseModel.php';

class Leitor extends BaseModel {
    private $id;
    private $nome;
    private $endereco;
    private $telefone;
    private $email;
    private $cpf;
    private $categoria;
    private $data_nascimento;

    public function __construct() {
        parent::__construct();
    }

    public function setId($id) {
        $this->id = $id;
    }

    public static function getAll() {
        $sql = 'SELECT * FROM leitores';
        $query = self::$conn->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public static function createLeitor($nome, $endereco, $telefone, $email, $cpf, $categoria, $data_nascimento) {
        $sql = 'INSERT INTO leitores (nome, endereco, telefone, email, cpf, categoria, data_nascimento) VALUES (:nome, :endereco, :telefone, :email, :cpf, :categoria, :data_nascimento)';
        $query = self::$conn->prepare($sql);
        $query->bindValue(':nome', $nome);
        $query->bindValue(':endereco', $endereco);
        $query->bindValue(':telefone', $telefone);
        $query->bindValue(':email', $email);
        $query->bindValue(':cpf', $cpf);
        $query->bindValue(':categoria', $categoria);
        $query->bindValue(':data_nascimento', $data_nascimento);
        return $query->execute();
    }

    public static function updateLeitor($id, $nome, $cpf, $endereco, $cidade, $estado, $telefone, $email, $categoria, $data_nascimento) {
        $sql = 'UPDATE leitores SET nome = :nome, cpf = :cpf, endereco = :endereco, cidade = :cidade, estado = :estado, telefone = :telefone, email = :email, categoria = :categoria, data_nascimento = :data_nascimento WHERE id = :id';
        $query = self::$conn->prepare($sql);
        $query->bindValue(':id', $id);
        $query->bindValue(':nome', $nome);
        $query->bindValue(':cpf', $cpf);
        $query->bindValue(':endereco', $endereco);
        $query->bindValue(':cidade', $cidade);
        $query->bindValue(':estado', $estado);
        $query->bindValue(':telefone', $telefone);
        $query->bindValue(':email', $email);
        $query->bindValue(':categoria', $categoria);
        $query->bindValue(':data_nascimento', $data_nascimento);
        // se deu tudo certo, retorna true. Senão, false
        return $query->execute();
    }

    public static function getLeitor($id) {
        $sql = 'SELECT * FROM leitores WHERE id = :id';
        $query = self::$conn->prepare($sql);
        $query->bindValue(':id', $id);
        try {
            $query->execute();
            return $query->fetch(PDO::FETCH_OBJ);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function deletarLeitor($id) {
        $sql = 'DELETE FROM leitores WHERE id = :id';
        $query = self::$conn->prepare($sql);
        $query->bindValue(':id', $id);
        return $query->execute();
    }


}