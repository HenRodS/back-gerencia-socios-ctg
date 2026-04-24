<?php

namespace Service;

use Model\Mensalidade;
use Repository\MensalidadeRepository;

class MensalidadeService
{
    private MensalidadeRepository $repository;

    public function __construct()
    {
        $this->repository = new MensalidadeRepository();
    }

    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function findById(int $id): ?Mensalidade
    {
        return $this->repository->findById($id);
    }

    public function create(Mensalidade $mensalidade): Mensalidade
    {
        return $this->repository->create($mensalidade);
    }

    public function update(Mensalidade $mensalidade): void
    {
        $this->repository->update($mensalidade);
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
    }
}