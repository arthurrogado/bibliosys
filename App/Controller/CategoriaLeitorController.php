<?php

// CategoriaLeitorController.php

require_once './App/Model/CategoriaLeitor.php';

class CategoriaLeitorController {

    public function __construct() {}

    public function getAll() {
        $categoriaLeitor = new CategoriaLeitor();
        $categorias = $categoriaLeitor::getAll();
        if ($categorias) {
            echo json_encode(["ok" => true, "categorias" => $categorias]);
        } else {
            echo json_encode(["ok" => false, "message" => "Nenhuma categoria encontrada"]);
        }
        /* echo json_encode(["ok" => true, "categorias" => ["id" => 1, "nome" => "Estudante", "dias_emprestimo" => 7]]); */
    }

    public function getCategoriaLeitor($id) {
        $categoriaLeitor = new CategoriaLeitor();
        $dadosCategoriaLeitor = $categoriaLeitor::getCategoriaLeitor($id);
        if ($dadosCategoriaLeitor) {
            echo json_encode(["ok" => true, "categoria_leitor" => $dadosCategoriaLeitor]);
        } else {
            echo json_encode(["ok" => false, "message" => "Nenhuma categoria encontrada"]);
        }
    }

    public function createCategoriaLeitor($nome, $dias_emprestimo) {
        $categoriaLeitor = new CategoriaLeitor();
        $categoriaLeitor::createCategoriaLeitor($nome, $dias_emprestimo);
        if ($categoriaLeitor) {
            echo json_encode(["ok" => true, "categoria" => $categoriaLeitor]);
        } else {
            echo json_encode(["ok" => false, "message" => "Nenhuma categoria encontrada"]);
        }
    }

    public function updateCategoriaLeitor($id, $nome, $dias_emprestimo) {
        $categoriaLeitor = new CategoriaLeitor();
        $categoriaLeitor = $categoriaLeitor::updateCategoriaLeitor($id, $nome, $dias_emprestimo);
        if ($categoriaLeitor) {
            echo json_encode(["ok" => true, "categoria" => $categoriaLeitor]);
        } else {
            echo json_encode(["ok" => false, "message" => "Nenhuma categoria encontrada"]);
        }
    }

    public function deleteCategoriaLeitor($id) {
        $categoriaLeitor = new CategoriaLeitor();
        $categoriaLeitor = $categoriaLeitor::deleteCategoriaLeitor($id);
        if ($categoriaLeitor) {
            echo json_encode(["ok" => true, "categoria" => $categoriaLeitor]);
        } else {
            echo json_encode(["ok" => false, "message" => "Nenhuma categoria encontrada"]);
        }
    }

}