<?php

namespace Repository;

use Database\Database;
use Model\Dependente;
use PDO;
use DateTime;

class DependenteRepository
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    public function findAll(): array
    {
        $stmt = $this->connection->query("SELECT * FROM dependentes ORDER BY nome_completo");
        $dependentes = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $dependentes[] = $this->mapRowToDependente($row);
        }

        return $dependentes;
    }

    public function findById(int $id): ?Dependente
    {
        $stmt = $this->connection->prepare("SELECT * FROM dependentes WHERE id = ?");
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $this->mapRowToDependente($row) : null;
    }

    public function findBySocioTitular(int $socioTitularId): array
    {
        $stmt = $this->connection->prepare(
            "SELECT * FROM dependentes WHERE socio_titular_id = ? ORDER BY nome_completo"
        );
        $stmt->execute([$socioTitularId]);

        $dependentes = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $dependentes[] = $this->mapRowToDependente($row);
        }

        return $dependentes;
    }

    public function create(Dependente $dependente): Dependente
    {
        $stmt = $this->connection->prepare(
            "INSERT INTO dependentes 
             (socio_titular_id, nome_completo, cpf, telefone, identidade, endereco, 
              data_nascimento, data_entrada, categoria_id, dancarino, paga_instrutor) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );

        $stmt->execute([
            $dependente->getSocioTitularId(),
            $dependente->getNomeCompleto(),
            $dependente->getCpf(),
            $dependente->getTelefone(),
            $dependente->getIdentidade(),
            $dependente->getEndereco(),
            $dependente->getDataNascimento()->format('Y-m-d'),
            $dependente->getDataEntrada()->format('Y-m-d'),
            $dependente->getCategoriaId(),
            $dependente->isDancarino() ? 1 : 0,
            $dependente->isPagaInstrutor() ? 1 : 0
        ]);

        $dependente->setId((int)$this->connection->lastInsertId());
        return $dependente;
    }

    public function update(Dependente $dependente): void
    {
        $stmt = $this->connection->prepare(
            "UPDATE dependentes SET 
             socio_titular_id = ?, nome_completo = ?, cpf = ?, telefone = ?, 
             identidade = ?, endereco = ?, data_nascimento = ?, data_entrada = ?, 
             categoria_id = ?, dancarino = ?, paga_instrutor = ? 
             WHERE id = ?"
        );

        $stmt->execute([
            $dependente->getSocioTitularId(),
            $dependente->getNomeCompleto(),
            $dependente->getCpf(),
            $dependente->getTelefone(),
            $dependente->getIdentidade(),
            $dependente->getEndereco(),
            $dependente->getDataNascimento()->format('Y-m-d'),
            $dependente->getDataEntrada()->format('Y-m-d'),
            $dependente->getCategoriaId(),
            $dependente->isDancarino() ? 1 : 0,
            $dependente->isPagaInstrutor() ? 1 : 0,
            $dependente->getId()
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->connection->prepare("DELETE FROM dependentes WHERE id = ?");
        $stmt->execute([$id]);
    }

    private function mapRowToDependente(array $row): Dependente
    {
        return new Dependente(
            socioTitularId: (int)$row['socio_titular_id'],
            nomeCompleto: $row['nome_completo'],
            cpf: $row['cpf'],
            telefone: $row['telefone'],
            identidade: $row['identidade'],
            endereco: $row['endereco'],
            dataNascimento: new DateTime($row['data_nascimento']),
            dataEntrada: new DateTime($row['data_entrada']),
            categoriaId: (int)$row['categoria_id'],
            dancarino: (bool)$row['dancarino'],
            pagaInstrutor: (bool)$row['paga_instrutor'],
            id: (int)$row['id']
        );
    }
}