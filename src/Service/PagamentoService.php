<?php

namespace Service;

use Model\Pagamento;
use Repository\PagamentoRepository;

class PagamentoService
{
    private PagamentoRepository $repository;

    public function __construct()
    {
        $this->repository = new PagamentoRepository();
    }

    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function findById(int $id): ?Pagamento
    {
        return $this->repository->findById($id);
    }

    public function create(Pagamento $pagamento): Pagamento
    {
        return $this->repository->create($pagamento);
    }

    public function update(Pagamento $pagamento): void
    {
        $this->repository->update($pagamento);
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
    }
}