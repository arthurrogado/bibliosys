<?php

// ObraController.php

require_once './App/Model/Obra.php';

class ObraController {
    
    public function createObra($titulo, $isbn, $id_categoria_literaria, $autores, $palavras_chave, $data_publicacao, $edicao, $editora, $paginas) {
        $obra = new Obra();
        $response = $obra->criarObra($titulo, $isbn, $id_categoria_literaria, $autores, $palavras_chave, $data_publicacao, $edicao, $editora, $paginas);
        if($response) {
            echo json_encode(["status" => "Obra criada com sucesso", "ok" => true]);
        } else {
            echo json_encode(["status" => "Erro ao criar obra", "ok" => false]);
        }
    }

    public function getObras() {
        $obra = new Obra();
        $response = $obra->getObras();
        if($response) {
            echo json_encode(["status" => "Obras listadas com sucesso", "ok" => true, "obras" => $response]);
        } else {
            echo json_encode(["status" => "Erro ao listar obras", "ok" => false]);
        }
    }

    public function getObra($id_obra) {
        $obra = new Obra();
        $response = $obra::getObra($id_obra);
        if($response) {
            echo json_encode(["status" => "Obra listada com sucesso", "ok" => true, "obra" => $response]);
        } else {
            echo json_encode(["status" => "Erro ao listar obra", "ok" => false]);
        }
    }

    public function updateObra($id_obra, $titulo, $isbn, $id_categoria_literaria, $autores, $palavras_chave, $data_publicacao, $edicao, $editora, $paginas) {
        $obra = new Obra();
        $response = $obra->updateObra($id_obra, $titulo, $isbn, $id_categoria_literaria, $autores, $palavras_chave, $data_publicacao, $edicao, $editora, $paginas);
        if($response) {
            echo json_encode(["status" => "Obra atualizada com sucesso", "ok" => true]);
        } else {
            echo json_encode(["status" => "Erro ao atualizar obra", "ok" => false]);
        }
    }

    public function deleteObra($id_obra) {
        $obra = new Obra();
        $response = $obra->deleteObra($id_obra);
        if($response) {
            echo json_encode(["status" => "Obra deletada com sucesso", "ok" => true]);
        } else {
            echo json_encode(["status" => "Erro ao deletar obra", "ok" => false]);
        }
    }

}

?>