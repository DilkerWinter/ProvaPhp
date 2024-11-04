<?php

namespace controller;

use service\LivroService;
use model\Livro;

class LivroController {
    private $livroService;

    public function __construct(LivroService $livroService) {
        $this->livroService = $livroService;
    }

    public function getAllLivros() {
        $livros = $this->livroService->getAllLivros();

        echo json_encode(array_map(function($livro) {
            return [
                'titulo' => $livro->getTitulo(),
                'autor' => $livro->getAutor(),
                'descricao' => $livro->getDescricao(),
                'imagemUrl' => $livro->getImagemUrl(),
                'finalizado' => $livro->isFinalizado(),
                'nota' => $livro->getNota()
            ];
        }, $livros));
    }

    public function createLivro() {
        $data = json_decode(file_get_contents("php://input"), true);
        $livro = new Livro($data['titulo'], $data['autor'], $data['descricao'], $data['imagemUrl'], $data['finalizado'], $data['nota']);
        $this->livroService->createLivro($livro);
        echo json_encode(['message' => 'Livro criado com sucesso!']);
    }
}

