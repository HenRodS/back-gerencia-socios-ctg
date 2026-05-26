<?php
namespace Service;

use Model\Dependente;
use Repository\DependenteRepository;

class DependenteService
{
    private DependenteRepository $dependenteRepository;

    public function __construct()
    {
        $this->dependenteRepository = new DependenteRepository();
    }

    public function findAll(): array
    {
        return $this->dependenteRepository->findAll();
    }

    public function findById(int $id): ?Dependente
    {
        return $this->dependenteRepository->findById($id);
    }

    public function findBySocioTitular(int $socioTitularId): array
    {
        return $this->dependenteRepository->findBySocioTitular($socioTitularId);
    }

    public function create(Dependente $dependente): Dependente
    {
        return $this->dependenteRepository->create($dependente);
    }

    public function update(Dependente $dependente): void
    {
        $this->dependenteRepository->update($dependente);
    }

    public function delete(int $id): void
    {
        $this->dependenteRepository->delete($id);
    }
}
