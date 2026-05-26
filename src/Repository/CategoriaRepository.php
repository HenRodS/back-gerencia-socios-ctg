<?php

namespace Repository;

use Database\Database;
use Model\Categoria;
use PDO;

class CategoriaRepository
{
    private $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    public function findAll(): array
    {
        $stmt = $this->connection->prepare("SELECT * FROM categorias");
        $stmt->execute();

        $categorias = [];

        while ($row = $stmt->fetch()) {
            $categoria = new Categoria(
                nome: $row['nome'],
                valorSociedade: $row['valor_sociedade'],
                valorInstrutor: $row['valor_instrutor'],
                id: $row['id']
            );

            $categorias[] = $categoria;
        }

        return $categorias;
    }

    public function findById(int $id): ?Categoria
    {
        $stmt = $this->connection->prepare("
            SELECT * FROM categorias
            WHERE id = :id
        ");

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return new Categoria(
            nome: $row['nome'],
            valorSociedade: $row['valor_sociedade'],
            valorInstrutor: $row['valor_instrutor'],
            id: $row['id']
        );
    }

    public function create(Categoria $categoria): Categoria
    {
        $stmt = $this->connection->prepare("
            INSERT INTO categorias (
                nome,
                valor_sociedade,
                valor_instrutor
            )
            VALUES (
                :nome,
                :valor_sociedade,
                :valor_instrutor
            )
        ");

        $stmt->bindValue(':nome', $categoria->getNome());
        $stmt->bindValue(':valor_sociedade', $categoria->getValorSociedade());
        $stmt->bindValue(':valor_instrutor', $categoria->getValorInstrutor());

        $stmt->execute();

        // Get the last inserted ID and return a new instance with it
        $lastId = $this->connection->lastInsertId();
        return new Categoria(
            nome: $categoria->getNome(),
            valorSociedade: $categoria->getValorSociedade(),
            valorInstrutor: $categoria->getValorInstrutor(),
            id: (int)$lastId
        );
    }

    public function update(Categoria $categoria): void
    {
        $stmt = $this->connection->prepare("
            UPDATE categorias SET
                nome = :nome,
                valor_sociedade = :valor_sociedade,
                valor_instrutor = :valor_instrutor
            WHERE id = :id
        ");

        $stmt->bindValue(':id', $categoria->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':nome', $categoria->getNome());
        $stmt->bindValue(':valor_sociedade', $categoria->getValorSociedade());
        $stmt->bindValue(':valor_instrutor', $categoria->getValorInstrutor());

        $stmt->execute();
    }

    public function delete(int $id): void
    {
        $stmt = $this->connection->prepare("DELETE FROM categorias WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
