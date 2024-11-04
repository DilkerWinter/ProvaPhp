<?php

namespace service;

use model\Livro;

class LivroService {
    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    public function getAllLivros(): array {
        $query = "SELECT titulo, autor, descricao, imagemUrl, finalizado, nota FROM livro";
        $stmt = $this->con->query($query);
        $livros = [];

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $livros[] = new Livro(
                $row['titulo'],
                $row['autor'],
                $row['descricao'],
                $row['imagemUrl'],
                $row['finalizado'],
                $row['nota']
            );
        }

        return $livros;
    }

    public function createLivro(Livro $livro): bool {
        $query = "INSERT INTO livro (titulo, autor, descricao, imagemUrl, finalizado, nota) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->con->prepare($query);
        return $stmt->execute([
            $livro->getTitulo(),
            $livro->getAutor(),
            $livro->getDescricao(),
            $livro->getImagemUrl(),
            $livro->isFinalizado(),
            $livro->getNota()
        ]);
    }
}
