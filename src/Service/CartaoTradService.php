<?php
namespace Service;

use Model\CartaoTrad;
use Repository\CartaoTradRepository;

class CartaoTradService
{
    private CartaoTradRepository $cartaoRepository;

    public function __construct()
    {
        $this->cartaoRepository = new CartaoTradRepository();
    }

    public function findAll(): array
    {
        return $this->cartaoRepository->findAll();
    }

    public function findById(int $id): ?CartaoTrad
    {
        return $this->cartaoRepository->findById($id);
    }

    public function create(CartaoTrad $cartao): CartaoTrad
    {
        return $this->cartaoRepository->create($cartao);
    }

    public function update(CartaoTrad $cartao): void
    {
        $this->cartaoRepository->update($cartao);
    }

    public function delete(int $id): void
    {
        $this->cartaoRepository->delete($id);
    }
}