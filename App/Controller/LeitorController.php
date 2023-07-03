<?php

// LeitorController.php

require_once './App/Model/Leitor.php';

class LeitorController {

    public function __construct() {
        
    }

    public function getLeitor($id) {
        $leitor = new Leitor();
        $dadosLeitor = $leitor::getLeitor($id);
        if ($dadosLeitor) {
            echo json_encode(["status" => "OK", "leitor" => $dadosLeitor, "ok" => true]);
        } else {
            echo json_encode(["status" => "Not Found", "message" => "Nenhum leitor encontrado", "ok" => false]);
        }
        
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
        if($leitor) {
            echo json_encode(["status" => "OK", "data" => $leitor, "ok" => true]);
        } else {
            echo json_encode(["status" => "Not Found", "message" => "Nenhum leitor encontrado", "ok" => false]);
        }
    }

    public function editarLeitor($id, $nome, $cpf, $endereco, $cidade, $estado, $telefone, $email, $categoria, $data_nascimento) {
        $leitor = new Leitor();
        $leitor = Leitor::updateLeitor($id, $nome, $cpf, $endereco, $cidade, $estado, $telefone, $email, $categoria, $data_nascimento);
        if($leitor) {
            echo json_encode(["status" => "OK", "data" => $leitor, "ok" => true]);
        } else {
            echo json_encode(["status" => "Not Found", "message" => "Nenhum leitor encontrado", "ok" => false]);
        }
    }

    public function deletarLeitor($id) {
        $leitor = new Leitor();
        $leitor = Leitor::deletarLeitor($id);
        if ($leitor) {
            echo json_encode(["status" => "OK", "data" => $leitor, "ok" => true]);
        } else {
            echo json_encode(["status" => "Not Found", "message" => "Nenhum leitor encontrado", "ok" => false]);
        }
    } 
}