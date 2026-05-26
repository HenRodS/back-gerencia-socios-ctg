<?php

namespace Controller;

use Error\APIException;
use Http\Request;
use Http\Response;
use Model\Categoria;
use Service\CategoriaService;

class CategoriaController
{
    private CategoriaService $service;

    public function __construct()
    {
        $this->service = new CategoriaService();
    }

    public function processRequest(Request $request): void
    {
        $id = $request->getId();
        $method = $request->getMethod();

        switch ($method) {

            case "GET":

                if ($id) {
                    $categoria = $this->service->findById($id);

                    if (!$categoria) {
                        throw new APIException("Categoria not found!", 404);
                    }

                    Response::send($categoria);
                    return;
                }

                Response::send($this->service->findAll());
                break;

            case "POST":

                $data = $request->getBody();

                $categoria = new Categoria(
                    nome: $data['nome'],
                    valorSociedade: $data['valor_sociedade'],
                    valorInstrutor: $data['valor_instrutor']
                );

                $created = $this->service->create($categoria);

                Response::send($created, 201);

                break;

            case "PUT":

                if (!$id) {
                    throw new APIException("ID is required!", 400);
                }

                $data = $request->getBody();

                $categoria = new Categoria(
                    nome: $data['nome'],
                    valorSociedade: $data['valor_sociedade'],
                    valorInstrutor: $data['valor_instrutor'],
                    id: $id
                );

                $this->service->update($categoria);

                Response::send([
                    "message" => "Categoria updated successfully"
                ]);

                break;

            case "DELETE":

                if (!$id) {
                    throw new APIException("ID is required!", 400);
                }

                $this->service->delete($id);

                Response::send([
                    "message" => "Categoria deleted successfully"
                ]);

                break;

            default:
                throw new APIException("Method not allowed!", 405);
        }
    }
}
