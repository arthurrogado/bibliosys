<?php

// LeitorController.php

require_once './App/Model/Leitor.php';

class LeitorController {

    public function __construct() {
        
    }

    public function listarLeitores() {
        $leitor = new Leitor();
        $leitores = $leitor::getAll();
        if ($leitores) {
            echo json_encode(["status" => "OK", "leitores" => $leitores, "ok" => true]);
        } else {
            echo json_encode(["status" => "Not Found", "message" => "Nenhum leitor encontrado", "ok" => false]);
        }
    }

    public function cadastrarLeitor($nome, $endereco, $telefone, $email, $cpf, $categoria, $data_nascimento) {
        $leitor = new Leitor();
        $leitor::createLeitor($nome, $endereco, $telefone, $email, $cpf, $categoria, $data_nascimento);
        if ($leitor) {
            echo json_encode(["status" => "OK", "data" => $leitor, "ok" => true]);
        } else {
            echo json_encode(["status" => "Not Found", "message" => "Nenhum leitor encontrado", "ok" => false]);
        }
    }

    public function buscarLeitor($id) {
        $leitor = Leitor::getLeitor($id);
        if ($leitor) {
            echo json_encode(["status" => "OK", "data" => $leitor, "ok" => true]);
        } else {
            echo json_encode(["status" => "Not Found", "message" => "Nenhum leitor encontrado", "ok" => false]);
        }
    }

    public function editarLeitor($id, $nome, $endereco, $telefone, $email, $cpf, $categoria, $data_nascimento) {
        $leitor = Leitor::updateLeitor($id, $nome, $endereco, $telefone, $email, $cpf, $categoria, $data_nascimento);
        if ($leitor) {
            echo json_encode(["status" => "OK", "data" => $leitor, "ok" => true]);
        } else {
            echo json_encode(["status" => "Not Found", "message" => "Nenhum leitor encontrado", "ok" => false]);
        }
    }

    public function deletarLeitor($id) {
        $leitor = Leitor::deleteLeitor($id);
        if ($leitor) {
            echo json_encode(["status" => "OK", "data" => $leitor, "ok" => true]);
        } else {
            echo json_encode(["status" => "Not Found", "message" => "Nenhum leitor encontrado", "ok" => false]);
        }
    } 
}