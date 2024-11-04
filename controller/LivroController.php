<?php
require_once '../model/Livro.php';

class LivroController
{
    private $livro;

    public function __construct($db)
    {
        $this->livro = new \model\Livro($db);
    }

    public function list()
    {
        $livros = $this->livro->list();
        echo json_encode($livros);
    }

    public function create()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->titulo) && isset($data->autor) && isset($data->descricao) && isset($data->imagemUrl) && isset($data->finalizado) && isset($data->nota)) {
            try {
                $this->livro->create($data->titulo, $data->autor, $data->descricao, $data->imagemUrl, $data->finalizado, $data->nota);

                http_response_code(201);
                echo json_encode(["message" => "Livro criado com sucesso."]);
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao criar o livro."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function getById($id)
    {
        if (isset($id)) {
            try {
                $livro = $this->livro->getById($id);
                if ($livro) {
                    echo json_encode($livro);
                } else {
                    http_response_code(404);
                    echo json_encode(["message" => "Livro não encontrado."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao buscar o livro."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    public function update($id)
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($id) && isset($data->titulo) && isset($data->autor) && isset($data->descricao) && isset($data->imagemUrl) && isset($data->finalizado) && isset($data->nota)) {
            try {
                $count = $this->livro->update($id, $data->titulo, $data->autor, $data->descricao, $data->imagemUrl, $data->finalizado, $data->nota);
                if ($count > 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Livro atualizado com sucesso."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao atualizar o livro."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao atualizar o livro."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }
    

    public function delete($id)
    {
        if (isset($id)) {
            try {
                $count = $this->livro->delete($id);
                if ($count > 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Livro deletado com sucesso."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao deletar o livro."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao deletar o livro."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }
}
