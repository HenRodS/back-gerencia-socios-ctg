<?php
namespace Model;

use DateTime;
use JsonSerializable;

class CartaoTrad implements JsonSerializable {

    private ?int $id;
    private ?int $socioId;
    private ?int $dependenteId;
    private DateTime $dataSolicitacao;
    private bool $pago;
    private float $valor;

    public function __construct(
        ?int $socioId,
        ?int $dependenteId,
        DateTime $dataSolicitacao,
        bool $pago,
        float $valor,
        ?int $id = null
    ) {
        $this->id = $id;
        $this->socioId = $socioId;
        $this->dependenteId = $dependenteId;
        $this->dataSolicitacao = $dataSolicitacao;
        $this->pago = $pago;
        $this->valor = $valor;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getSocioId(): ?int {
        return $this->socioId;
    }

    public function getDependenteId(): ?int {
        return $this->dependenteId;
    }

    public function getDataSolicitacao(): DateTime {
        return $this->dataSolicitacao;
    }

    public function isPago(): bool {
        return $this->pago;
    }

    public function getValor(): float {
        return $this->valor;
    }

    public function jsonSerialize(): array {
        return [
            'id' => $this->id,
            'socio_id' => $this->socioId,
            'dependente_id' => $this->dependenteId,
            'data_solicitacao' => $this->dataSolicitacao->format('Y-m-d'),
            'pago' => $this->pago,
            'valor' => $this->valor
        ];
    }
}