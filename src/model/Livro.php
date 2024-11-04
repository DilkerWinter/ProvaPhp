<?php

namespace model;

use PDO;
use InvalidArgumentException;

class Livro {
    private $conn;
    private $titulo;
    private $autor;
    private $descricao;
    private $imagemUrl;
    private $finalizado;
    private $nota;

    public function __construct($db) {
        $this->conn = $db; 
    }

    public function create($titulo, $autor, $descricao, $imagemUrl, $finalizado, $nota) {
        $sql = "INSERT INTO livro (titulo, autor, descricao, imagemUrl, finalizado, nota) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$titulo, $autor, $descricao, $imagemUrl, $finalizado, $nota]);
    }
    
    public function list() {
        $sql = "SELECT * FROM livro";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT * FROM livro WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $titulo, $autor, $descricao, $imagemUrl, $finalizado, $nota) {
        $sql = "UPDATE livro SET titulo = :titulo, autor = :autor, descricao = :descricao, imagemUrl = :imagemUrl, finalizado = :finalizado, nota = :nota WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':imagemUrl', $imagemUrl);
        $stmt->bindParam(':finalizado', $finalizado, PDO::PARAM_BOOL);
        $stmt->bindParam(':nota', $nota, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM livro WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getTitulo() { return $this->titulo; }
    public function getAutor() { return $this->autor; }
    public function getDescricao() { return $this->descricao; }
    public function getImagemUrl() { return $this->imagemUrl; }
    public function isFinalizado() { return $this->finalizado; }
    public function getNota() { return $this->nota; }

    public function setTitulo($titulo) { $this->titulo = $titulo; }
    public function setAutor($autor) { $this->autor = $autor; }
    public function setDescricao($descricao) { $this->descricao = $descricao; }
    public function setImagemUrl($imagemUrl) { $this->imagemUrl = $imagemUrl; }
    public function setFinalizado($finalizado) { $this->finalizado = $finalizado; }
    public function setNota($nota) {
        if ($nota < 1 || $nota > 5) {
            throw new InvalidArgumentException('A nota deve estar entre 1 e 5.');
        }
        $this->nota = $nota;
    }
}
