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
    public static function criarObra($titulo, $isbn, $id_categoria_literaria, $autores, $palavras_chave, $data_publicacao, $edicao, $editora, $paginas) {
        $sql = 'INSERT INTO obras (titulo, isbn, id_categoria_literaria, autores, palavras_chave, data_publicacao, edicao, editora, paginas) VALUES (:titulo, :isbn, :id_categoria_literaria, :autores, :palavras_chave, :data_publicacao, :edicao, :editora, :paginas)';
        $query = self::$conn->prepare($sql);
        $query->bindValue(':titulo', $titulo);
        $query->bindValue(':isbn', $isbn);
        // se id_categoria_literaria for vazio, atribui null
        $id_categoria_literaria = $id_categoria_literaria == '' ? null : $id_categoria_literaria;
        $query->bindValue(':id_categoria_literaria', $id_categoria_literaria);
        
        $query->bindValue(':autores', $autores);
        $query->bindValue(':palavras_chave', $palavras_chave);
        $query->bindValue(':data_publicacao', $data_publicacao);
        $query->bindValue(':edicao', $edicao);
        $query->bindValue(':editora', $editora);
        $query->bindValue(':paginas', $paginas);
        return $query->execute();
    }

    public static function getObras() {
        $sql = 'SELECT * FROM obras';
        $query = self::$conn->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public static function updateObra($id, $titulo, $isbn, $id_categoria_literaria, $autores, $palavras_chave, $data_publicacao, $edicao, $editora, $paginas) {
        $sql = 'UPDATE obras SET titulo = :titulo, isbn = :isbn, id_categoria_literaria = :id_categoria_literaria, autores = :autores, palavras_chave = :palavras_chave, data_publicacao = :data_publicacao, edicao = :edicao, editora = :editora, paginas = :paginas WHERE id = :id';
        $query = self::$conn->prepare($sql);
        $query->bindValue(':id', $id);
        $query->bindValue(':titulo', $titulo);
        $query->bindValue(':isbn', $isbn);
        // se id_categoria_literaria for vazio, atribui null
        $id_categoria_literaria = $id_categoria_literaria == '' ? null : $id_categoria_literaria;
        $query->bindValue(':id_categoria_literaria', $id_categoria_literaria);
        
        $query->bindValue(':autores', $autores);
        $query->bindValue(':palavras_chave', $palavras_chave);
        $query->bindValue(':data_publicacao', $data_publicacao);
        $query->bindValue(':edicao', $edicao);
        $query->bindValue(':editora', $editora);
        $query->bindValue(':paginas', $paginas);
        return $query->execute();
    }

    public static function deleteObra($id) {
        $sql = 'DELETE FROM obras WHERE id = :id';
        $query = self::$conn->prepare($sql);
        $query->bindValue(':id', $id);
        return $query->execute();
    }


}