<?php

// EmprestimoController.php

require_once './App/Model/Emprestimo.php';

class EmprestimoController {

    public function __construct() {}

    public function getEmprestimos() {
        $emprestimo = new Emprestimo();
        $emprestimos = $emprestimo::getAll();
        if ($emprestimos) {
            echo json_encode(["ok" => true, "emprestimos" => $emprestimos]);
        } else {
            echo json_encode(["ok" => false, "message" => "Nenhum emprestimo encontrado"]);
        }
    }

    public function getEmprestimo($id) {
        $emprestimo = new Emprestimo();
        $dadosEmprestimo = $emprestimo::getEmprestimo($id);
        if ($dadosEmprestimo) {
            echo json_encode(["ok" => true, "emprestimo" => $dadosEmprestimo]);
        } else {
            echo json_encode(["ok" => false, "message" => "Nenhum emprestimo encontrado"]);
        }
    }

    // $data_emprestimo, $data_prevista_devolucao, $id_leitor, $id_obra, $id_funcionario_responsavel

    public function createEmprestimo($data_emprestimo, $data_prevista_devolucao, $id_leitor, $id_obra, $id_funcionario_responsavel) {
        $emprestimo = new Emprestimo();
        $result = $emprestimo::createEmprestimo(
            $data_emprestimo, 
            $data_prevista_devolucao, 
            $id_leitor, 
            $id_obra, 
            $id_funcionario_responsavel
        );
        if ($result) {
            echo json_encode(["ok" => true, "message" => "Emprestimo criado com sucesso"]);
        } else {
            echo json_encode(["ok" => false, "message" => "Erro ao criar emprestimo"]);
        }
    }

    public function updateEmprestimo($id, $data_emprestimo, $data_prevista_devolucao, $id_leitor, $id_obra, $id_funcionario_responsavel) {
        $emprestimo = new Emprestimo();
        $result = $emprestimo::updateEmprestimo(
            $id, 
            $data_emprestimo, 
            $data_prevista_devolucao, 
            $id_leitor, 
            $id_obra, 
            $id_funcionario_responsavel
        );
        if ($result) {
            echo json_encode(["ok" => true, "message" => "Emprestimo atualizado com sucesso"]);
        } else {
            echo json_encode(["ok" => false, "message" => "Erro ao atualizar emprestimo"]);
        }
    }

    public function deleteEmprestimo($id) {
        $emprestimo = new Emprestimo();
        $result = $emprestimo::deleteEmprestimo($id);
        if ($result) {
            echo json_encode(["ok" => true, "message" => "Emprestimo deletado com sucesso"]);
        } else {
            echo json_encode(["ok" => false, "message" => "Erro ao deletar emprestimo"]);
        }
    }

}