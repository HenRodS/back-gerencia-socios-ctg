<?php

namespace Controller;

use Error\APIException;
use Http\Request;
use Http\Response;
use Model\CartaoTrad;
use Service\CartaoTradService;
use DateTime;

class CartaoTradController {

    private CartaoTradService $cartaoService;

    public function __construct() {
        $this->cartaoService = new CartaoTradService();
    }

    public function processRequest(Request $request): void {
        $id = $request->getId();
        $method = $request->getMethod();

        switch ($method) {

            case "GET":
                if ($id) {
                    $cartao = $this->cartaoService->findById((int)$id);

                    if (!$cartao) {
                        throw new APIException("Cartão não encontrado!", 404);
                    }

                    Response::send($cartao);
                    return;
                }

                Response::send($this->cartaoService->findAll());
                break;

            case "POST":
                $data = $request->getBody();

                // validações básicas
                if (
                    empty($data['data_entrada']) ||
                    empty($data['validade']) ||
                    empty($data['entidade_filiada']) ||
                    empty($data['matricula']) ||
                    empty($data['nome_patrao'])
                ) {
                    throw new APIException("Campos obrigatórios não informados!", 400);
                }

                $cartao = new CartaoTrad(
                    new DateTime($data['data_entrada']),
                    new DateTime($data['validade']),
                    $data['entidade_filiada'],
                    (int)$data['matricula'],
                    $data['nome_patrao']
                );

                $created = $this->cartaoService->create($cartao);

                Response::send($created, 201);
                break;

            case "PUT":
                if (!$id) {
                    throw new APIException("ID é obrigatório!", 400);
                }

                $data = $request->getBody();

                $cartao = new CartaoTrad(
                    new DateTime($data['data_entrada']),
                    new DateTime($data['validade']),
                    $data['entidade_filiada'],
                    (int)$data['matricula'],
                    $data['nome_patrao'],
                    (int)$id
                );

                $this->cartaoService->update($cartao);

                Response::send([
                    "message" => "Cartão atualizado com sucesso"
                ]);

                break;

            case "DELETE":
                if (!$id) {
                    throw new APIException("ID é obrigatório!", 400);
                }

                $this->cartaoService->delete($id);

                Response::send([
                    "message" => "Cartão excluído com sucesso"
                ]);

                break;

            default:
                throw new APIException("Método não permitido!", 405);
        }
    }
}