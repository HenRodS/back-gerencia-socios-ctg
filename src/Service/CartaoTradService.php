<?php
namespace Service;

use Error\APIException;
use Model\CartaoTrad;
use Repository\CartaoTradRepository;
use DateTime;

class CartaoTradService
{
    private CartaoTradRepository $cartaoRepository;

    public function __construct(){
        $this->cartaoRepository = new CartaoTradRepository();
    }

    public function findAll(): array {
        return $this->cartaoRepository->findAll();
    }

    public function findById(int $id): ?CartaoTrad {
        return $this->cartaoRepository->findById($id);
    }

    public function create(CartaoTrad $cartao): CartaoTrad {

        // validações básicas
        if (!$cartao->getDataEntrada() ||
            !$cartao->getValidade() ||
            !$cartao->getEntidadeFiliada() ||
            !$cartao->getMatricula() ||
            !$cartao->getNomePatrao()
        ) {
            throw new APIException("Dados inválidos para criação do cartão!", 400);
        }

        return $this->cartaoRepository->create($cartao);
    }

    public function update(CartaoTrad $cartao): CartaoTrad {

        if (!$cartao->getId()) {
            throw new APIException("ID é obrigatório para atualização!", 400);
        }

        $existing = $this->findById($cartao->getId());

        if (!$existing) {
            throw new APIException("Cartão não encontrado!", 404);
        }

        $this->cartaoRepository->update($cartao);

        return $cartao;
    }

    public function updateFromArray(int $id, array $data): CartaoTrad {

        $cartao = $this->findById($id);

        if (!$cartao) {
            throw new APIException("Cartão não encontrado!", 404);
        }

        // atualizações usando setters

        if (isset($data['data_entrada'])) {
            $cartao->setDataEntrada(new DateTime($data['data_entrada']));
        }

        if (isset($data['validade'])) {
            $cartao->setValidade(new DateTime($data['validade']));
        }

        if (isset($data['entidade_filiada'])) {
            $cartao->setEntidadeFiliada($data['entidade_filiada']);
        }

        if (isset($data['matricula'])) {
            $cartao->setMatricula((int)$data['matricula']);
        }

        if (isset($data['nome_patrao'])) {
            $cartao->setNomePatrao($data['nome_patrao']);
        }

        $this->cartaoRepository->update($cartao);

        return $cartao;
    }

    public function delete(int $id): void {

        $cartao = $this->findById($id);

        if (!$cartao) {
            throw new APIException("Cartão não encontrado!", 404);
        }

        $this->cartaoRepository->delete($id);
    }
}