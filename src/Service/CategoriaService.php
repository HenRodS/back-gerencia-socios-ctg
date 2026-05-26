<?php

namespace Service;

use Model\Categoria;
use Repository\CategoriaRepository;

class CategoriaService
{
    private CategoriaRepository $repository;

    public function __construct()
    {
        $this->repository = new CategoriaRepository();
    }

    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    public function findById(int $id): ?Categoria
    {
        return $this->repository->findById($id);
    }

    public function create(Categoria $categoria): Categoria
    {
        return $this->repository->create($categoria);
    }

    public function update(Categoria $categoria): void
    {
        $this->repository->update($categoria);
    }

    public function delete(int $id): void
    {
        $this->repository->delete($id);
    }
}
