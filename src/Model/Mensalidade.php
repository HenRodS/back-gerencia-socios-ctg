<?php

namespace Model;

use DateTime;

class Mensalidade {

    private ?int $id;
    private int $socioId;
    private ?int $dependenteId;
    private int $mes;
    private int $ano;
    private float $valor;
    private string $status;
    private DateTime $dataVencimento;

    public function __construct(
        int $socioId,
        ?int $dependenteId,
        int $mes,
        int $ano,
        float $valor,
        DateTime $dataVencimento,
        string $status = 'Pendente',
        ?int $id = null
    ) {
        $this->id = $id;
        $this->socioId = $socioId;
        $this->dependenteId = $dependenteId;
        $this->mes = $mes;
        $this->ano = $ano;
        $this->valor = $valor;
        $this->status = $status;
        $this->dataVencimento = $dataVencimento;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getSocioId(): int {
        return $this->socioId;
    }

    public function getDependenteId(): ?int {
        return $this->dependenteId;
    }

    public function getMes(): int {
        return $this->mes;
    }

    public function getAno(): int {
        return $this->ano;
    }

    public function getValor(): float {
        return $this->valor;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getDataVencimento(): DateTime {
        return $this->dataVencimento;
    }

    public function setStatus(string $status): void {
        $this->status = $status;
    }

    public function setValor(float $valor): void {
        $this->valor = $valor;
    }

    public function setDataVencimento(DateTime $dataVencimento): void {
        $this->dataVencimento = $dataVencimento;
    }
}