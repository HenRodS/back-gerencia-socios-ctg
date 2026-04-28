<?php

namespace Repository;

use Database\Database;
use Model\Socio;
use PDO;
use DateTime;
use \StatusSocio;

class SocioRepository
{
    private $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    public function findAll(): array
    {
        $stmt = $this->connection->prepare("SELECT * FROM socios");
        $stmt->execute();

        $socios = [];

        while ($row = $stmt->fetch()) {
            $socio = new Socio(
                $row['nome_completo'],
                $row['cpf'],
                $row['telefone'],
                $row['foto'] ?? '',
                $row['identidade'],
                $row['endereco'],
                new DateTime($row['data_nascimento']),
                new DateTime($row['data_entrada']),
                StatusSocio::from($row['status']),
                $row['categoria_id'],
                (bool)$row['dancarino'],
                (bool)$row['paga_instrutor'],
                $row['id']
            );

            $socios[] = $socio;
        }

        return $socios;
    }

    public function findById(int $id): ?Socio
    {
        $stmt = $this->connection->prepare("
            SELECT * FROM socios
            WHERE id = :id
        ");

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return new Socio(
            $row['nome_completo'],
            $row['cpf'],
            $row['telefone'],
            $row['foto'] ?? '',
            $row['identidade'],
            $row['endereco'],
            new DateTime($row['data_nascimento']),
            new DateTime($row['data_entrada']),
            StatusSocio::from($row['status']),
            $row['categoria_id'],
            (bool)$row['dancarino'],
            (bool)$row['paga_instrutor'],
            $row['id']
        );
    }

    public function findByName(string $name): array
    {
        $stmt = $this->connection->prepare("
            SELECT * FROM socios
            WHERE nome_completo LIKE :nome
        ");

        $stmt->bindValue(':nome', '%' . $name . '%');
        $stmt->execute();

        $socios = [];

        while ($row = $stmt->fetch()) {
            $socio = new Socio(
                $row['nome_completo'],
                $row['cpf'],
                $row['telefone'],
                $row['foto'] ?? '',
                $row['identidade'],
                $row['endereco'],
                new DateTime($row['data_nascimento']),
                new DateTime($row['data_entrada']),
                StatusSocio::from($row['status']),
                $row['categoria_id'],
                (bool)$row['dancarino'],
                (bool)$row['paga_instrutor'],
                $row['id']
            );

            $socios[] = $socio;
        }

        return $socios;
    }

    public function create(Socio $socio): Socio
    {
        $stmt = $this->connection->prepare("
            INSERT INTO socios (
                nome_completo,
                cpf,
                telefone,
                foto,
                identidade,
                endereco,
                data_nascimento,
                data_entrada,
                categoria_id,
                status,
                dancarino,
                paga_instrutor
            )
            VALUES (
                :nome_completo,
                :cpf,
                :telefone,
                :foto,
                :identidade,
                :endereco,
                :data_nascimento,
                :data_entrada,
                :categoria_id,
                :status,
                :dancarino,
                :paga_instrutor
            )
        ");

        $stmt->bindValue(':nome_completo', $socio->getNome());
        $stmt->bindValue(':cpf', $socio->getCpf());
        $stmt->bindValue(':telefone', $socio->getTelefone());
        $stmt->bindValue(':foto', $socio->getFoto());
        $stmt->bindValue(':identidade', $socio->getIdentidade());
        $stmt->bindValue(':endereco', $socio->getEndereco());
        $stmt->bindValue(
            ':data_nascimento',
            $socio->getDataNascimento()->format('Y-m-d')
        );
        $stmt->bindValue(
            ':data_entrada',
            $socio->getDataEntrada()->format('Y-m-d')
        );
        $stmt->bindValue(':categoria_id', $socio->getCategoriaId(), PDO::PARAM_INT);
        $stmt->bindValue(':status', $socio->getStatus()->value);
        $stmt->bindValue(':dancarino', $socio->isDancarino() ? 1 : 0, PDO::PARAM_INT);
        $stmt->bindValue(':paga_instrutor', $socio->isPagaInstrutor() ? 1 : 0, PDO::PARAM_INT);

        $stmt->execute();

        // Get the last inserted ID and return a new instance with it
        $lastId = $this->connection->lastInsertId();
        return new Socio(
            $socio->getNome(),
            $socio->getCpf(),
            $socio->getTelefone(),
            $socio->getFoto(),
            $socio->getIdentidade(),
            $socio->getEndereco(),
            $socio->getDataNascimento(),
            $socio->getDataEntrada(),
            $socio->getStatus(),
            $socio->getCategoriaId(),
            $socio->isDancarino(),
            $socio->isPagaInstrutor(),
            (int)$lastId
        );
    }

    public function update(Socio $socio): void
    {
        $stmt = $this->connection->prepare("
            UPDATE socios SET
                nome_completo = :nome_completo,
                cpf = :cpf,
                telefone = :telefone,
                foto = :foto,
                identidade = :identidade,
                endereco = :endereco,
                data_nascimento = :data_nascimento,
                data_entrada = :data_entrada,
                categoria_id = :categoria_id,
                status = :status,
                dancarino = :dancarino,
                paga_instrutor = :paga_instrutor
            WHERE id = :id
        ");

        $stmt->bindValue(':id', $socio->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':nome_completo', $socio->getNome());
        $stmt->bindValue(':cpf', $socio->getCpf());
        $stmt->bindValue(':telefone', $socio->getTelefone());
        $stmt->bindValue(':foto', $socio->getFoto());
        $stmt->bindValue(':identidade', $socio->getIdentidade());
        $stmt->bindValue(':endereco', $socio->getEndereco());
        $stmt->bindValue(
            ':data_nascimento',
            $socio->getDataNascimento()->format('Y-m-d')
        );
        $stmt->bindValue(
            ':data_entrada',
            $socio->getDataEntrada()->format('Y-m-d')
        );
        $stmt->bindValue(':categoria_id', $socio->getCategoriaId(), PDO::PARAM_INT);
        $stmt->bindValue(':status', $socio->getStatus()->value);
        $stmt->bindValue(':dancarino', $socio->isDancarino() ? 1 : 0, PDO::PARAM_INT);
        $stmt->bindValue(':paga_instrutor', $socio->isPagaInstrutor() ? 1 : 0, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function delete(int $id): void
    {
        $stmt = $this->connection->prepare("
            DELETE FROM socios
            WHERE id = :id
        ");

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
