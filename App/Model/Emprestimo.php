<?php

// Emprestimo.php

require_once './App/Model/BaseModel.php';

class Emprestimo extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    public static function getAll() {
        $sql = 'SELECT * FROM emprestimos';
        $query = self::$conn->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public static function getEmprestimo($id) {
        $sql = 'SELECT * FROM emprestimos WHERE id = :id';
        $query = self::$conn->prepare($sql);
        $query->bindValue(':id', $id);
        $query->execute();
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public static function createEmprestimo(
        $data_emprestimo, 
        $data_prevista_devolucao, 
        $id_leitor, 
        $id_obra, 
        $id_funcionario_responsavel
    ) {
        $sql = 'INSERT INTO emprestimos (data_emprestimo, data_prevista_devolucao, id_leitor, id_obra, id_funcionario_responsavel) VALUES (:data_emprestimo, :data_prevista_devolucao, :id_leitor, :id_obra, :id_funcionario_responsavel)';
        $query = self::$conn->prepare($sql);
        $query->bindValue(':data_emprestimo', $data_emprestimo);
        $query->bindValue(':data_prevista_devolucao', $data_prevista_devolucao);
        $query->bindValue(':id_leitor', $id_leitor);
        $query->bindValue(':id_obra', $id_obra);
        $query->bindValue(':id_funcionario_responsavel', $id_funcionario_responsavel);
        return $query->execute();
    }

    public static function makeEmprestimo($id_leitor, $id_obra, $id_funcionario_responsavel) {
        // alterar createEmprestimo para verificar se o usuário tem permissão de fazer o empréstimo em relação ao número máximo de dias de empréstimo, e verificar também em relação a obra, no seu número máximo de dias que pode ser emprestada
        $data_emprestimo = date('Y-m-d');
        $data_prevista_devolucao = date('Y-m-d');
                
    }

    public static function updateEmprestimo(
        $id, 
        $data_emprestimo, 
        $data_prevista_devolucao, 
        $id_leitor, 
        $id_obra, 
        $id_funcionario_responsavel
    ) {
        $sql = 'UPDATE emprestimos SET data_emprestimo = :data_emprestimo, data_prevista_devolucao = :data_prevista_devolucao, id_leitor = :id_leitor, id_obra = :id_obra, id_funcionario_responsavel = :id_funcionario_responsavel WHERE id = :id';
        $query = self::$conn->prepare($sql);
        $query->bindValue(':id', $id);
        $query->bindValue(':data_emprestimo', $data_emprestimo);
        $query->bindValue(':data_prevista_devolucao', $data_prevista_devolucao);
        $query->bindValue(':id_leitor', $id_leitor);
        $query->bindValue(':id_obra', $id_obra);
        $query->bindValue(':id_funcionario_responsavel', $id_funcionario_responsavel);
        return $query->execute();
    }

    public static function deleteEmprestimo($id) {
        $sql = 'DELETE FROM emprestimos WHERE id = :id';
        $query = self::$conn->prepare($sql);
        $query->bindValue(':id', $id);
        return $query->execute();
    }

}