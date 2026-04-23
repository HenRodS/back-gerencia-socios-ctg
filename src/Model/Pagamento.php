<?php

namespace Model;

use DateTime;

class Pagamento {

    private ?int $id;
    private int $mensalidadeId;
    private DateTime $dataPagamento;
    private string $formaPagamento;
    private float $valorPago;
    private float $multaJurosAplicados;

    public function __construct(
        int $mensalidadeId,
        DateTime $dataPagamento,
        string $formaPagamento,
        float $valorPago,
        float $multaJurosAplicados = 0,
        ?int $id = null
    ) {
        $this->id = $id;
        $this->mensalidadeId = $mensalidadeId;
        $this->dataPagamento = $dataPagamento;
        $this->formaPagamento = $formaPagamento;
        $this->valorPago = $valorPago;
        $this->multaJurosAplicados = $multaJurosAplicados;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getMensalidadeId(): int {
        return $this->mensalidadeId;
    }

    public function getDataPagamento(): DateTime {
        return $this->dataPagamento;
    }

    public function getFormaPagamento(): string {
        return $this->formaPagamento;
    }

    public function getValorPago(): float {
        return $this->valorPago;
    }

    public function getMultaJurosAplicados(): float {
        return $this->multaJurosAplicados;
    }

    public function setFormaPagamento(string $formaPagamento): void {
        $this->formaPagamento = $formaPagamento;
    }

    public function setValorPago(float $valorPago): void {
        $this->valorPago = $valorPago;
    }

    public function setMultaJurosAplicados(float $multaJurosAplicados): void {
        $this->multaJurosAplicados = $multaJurosAplicados;
    }
}