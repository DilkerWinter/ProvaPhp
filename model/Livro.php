<?php

namespace model;

class Livro {
    private $titulo;
    private $autor;
    private $descricao;
    private $imagemUrl;
    private $finalizado;
    private $nota;

    public function __construct($titulo, $autor, $descricao, $imagemUrl, $finalizado, $nota) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->descricao = $descricao;
        $this->imagemUrl = $imagemUrl;
        $this->finalizado = $finalizado;
        $this->nota = $nota;
    }

    public static function fromArray(array $data): Livro {
        return new self(
            $data['titulo'] ?? null,
            $data['autor'] ?? null,
            $data['descricao'] ?? null,
            $data['imagemUrl'] ?? null,
            $data['finalizado'] ?? false,
            $data['nota'] ?? 0
        );
    }



public function getAutor()
    {
        return $this->autor;
    }


    public function setAutor($autor)
    {
        $this->autor = $autor;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function isFinalizado()
    {
        return $this->finalizado;
    }


    public function getImagemUrl()
    {
        return $this->imagemUrl;
    }


    public function setImagemUrl($imagemUrl)
    {
        $this->imagemUrl = $imagemUrl;
    }

    public function getNota()
    {
        return $this->nota;
    }

    public function setNota($nota)
    {
        if ($nota < 1 || $nota > 5) {
            throw new InvalidArgumentException('A nota deve estar entre 1 e 5.');
        }
        $this->nota = $nota;
    }

    public function __toString()
    {
        return "Título: {$this->titulo}, Descrição: {$this->descricao}, Finalizado: " . ($this->finalizado ? 'Sim' : 'Não') . ", Nota: {$this->nota}";
    }


}


