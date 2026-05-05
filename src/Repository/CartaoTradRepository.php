<?php
namespace Repository;

use Model\CartaoTrad;
use PDO;
use DateTime;

class CartaoTradRepository
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = DatabaseConnection::getConnection();
    }

    public function findAll(): array
    {
        $stmt = $this->conn->query("SELECT * FROM cartao_trad");
        $result = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $this->mapRowToCartao($row);
        }

        return $result;
    }

    public function findById(int $id): ?CartaoTrad
    {
        $stmt = $this->conn->prepare("SELECT * FROM cartao_trad WHERE id = :id");
        $stmt->bindValue(":id", $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return $this->mapRowToCartao($row);
    }

    public function create(CartaoTrad $cartao): CartaoTrad
    {
        $stmt = $this->conn->prepare("
            INSERT INTO cartao_trad 
            (data_entrada, validade, entidade_filiada, matricula, nome_patrao)
            VALUES
            (:data_entrada, :validade, :entidade_filiada, :matricula, :nome_patrao)
        ");

        $stmt->execute([
            ':data_entrada' => $cartao->getDataEntrada()->format('Y-m-d'),
            ':validade' => $cartao->getValidade()->format('Y-m-d'),
            ':entidade_filiada' => $cartao->getEntidadeFiliada(),
            ':matricula' => $cartao->getMatricula(),
            ':nome_patrao' => $cartao->getNomePatrao()
        ]);

        $cartao->setId((int)$this->conn->lastInsertId());

        return $cartao;
    }

    public function update(CartaoTrad $cartao): void
    {
        $stmt = $this->conn->prepare("
            UPDATE cartao_trad SET
                data_entrada = :data_entrada,
                validade = :validade,
                entidade_filiada = :entidade_filiada,
                matricula = :matricula,
                nome_patrao = :nome_patrao
            WHERE id = :id
        ");

        $stmt->execute([
            ':id' => $cartao->getId(),
            ':data_entrada' => $cartao->getDataEntrada()->format('Y-m-d'),
            ':validade' => $cartao->getValidade()->format('Y-m-d'),
            ':entidade_filiada' => $cartao->getEntidadeFiliada(),
            ':matricula' => $cartao->getMatricula(),
            ':nome_patrao' => $cartao->getNomePatrao()
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->conn->prepare("DELETE FROM cartao_trad WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    private function mapRowToCartao(array $row): CartaoTrad
    {
        $cartao = new CartaoTrad(
            new DateTime($row['data_entrada']),
            new DateTime($row['validade']),
            $row['entidade_filiada'],
            (int)$row['matricula'],
            $row['nome_patrao']
        );

        $cartao->setId((int)$row['id']);

        return $cartao;
    }
}