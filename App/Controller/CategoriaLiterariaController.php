<?php

// CategoriaLiterariaController.php

require_once './App/Model/CategoriaLiteraria.php';

class CategoriaLiterariaController {

    public function __construct() {}

    public function getAll() {
        $categoriaLiteraria = new CategoriaLiteraria();
        $categorias = $categoriaLiteraria::getAll();
        if ($categorias) {
            echo json_encode(["ok" => true, "categorias" => $categorias]);
        } else {
            echo json_encode(["ok" => false, "message" => "Nenhuma categoria encontrada"]);
        }
    }

    public function getCategoriaLiteraria($id) {
        $categoriaLiteraria = new CategoriaLiteraria();
        $dadosCategoriaLiteraria = $categoriaLiteraria::getCategoriaLiteraria($id);
        if ($dadosCategoriaLiteraria) {
            echo json_encode(["ok" => true, "categoria_literaria" => $dadosCategoriaLiteraria]);
        } else {
            echo json_encode(["ok" => false, "message" => "Nenhuma categoria encontrada"]);
        }
    }

    public function createCategoriaLiteraria($nome, $dias_emprestimo, $multa_diaria) {
        $categoriaLiteraria = new CategoriaLiteraria();
        $categoriaLiteraria::createCategoriaLiteraria($nome, $dias_emprestimo, $multa_diaria);
        if ($categoriaLiteraria) {
            echo json_encode(["ok" => true, "categoria" => $categoriaLiteraria]);
        } else {
            echo json_encode(["ok" => false, "message" => "Nenhuma categoria encontrada"]);
        }
    }

    public function updateCategoriaLiteraria($id, $nome, $dias_emprestimo, $multa_diaria) {
        $categoriaLiteraria = new CategoriaLiteraria();
        $categoriaLiteraria = $categoriaLiteraria::updateCategoriaLiteraria($id, $nome, $dias_emprestimo, $multa_diaria);
        if ($categoriaLiteraria) {
            echo json_encode(["ok" => true, "categoria" => $categoriaLiteraria]);
        } else {
            echo json_encode(["ok" => false, "message" => "Nenhuma categoria encontrada"]);
        }
    }

    public function deleteCategoriaLiteraria($id) {
        $categoriaLiteraria = new CategoriaLiteraria();
        $categoriaLiteraria = $categoriaLiteraria::deleteCategoriaLiteraria($id);
        if ($categoriaLiteraria) {
            echo json_encode(["ok" => true, "categoria" => $categoriaLiteraria]);
        } else {
            echo json_encode(["ok" => false, "message" => "Nenhuma categoria encontrada"]);
        }
    }

}