<?php
namespace Model;

use DateTime;

class CartaoTrad {

    private ?int $id;
    private DateTime $dataEntrada;
    private DateTime $validade;
    private string $entidadeFiliada;
    private string $nomePatrao;
    private int $matricula;

    public function __construct(
        DateTime $dataEntrada,
        DateTime $validade,
        string $entidadeFiliada,
        int $matricula,
        string $nomePatrao,
        ?int $id = null
    ) {
        $this->id = $id;
        $this->dataEntrada = $dataEntrada;
        $this->validade = $validade;
        $this->entidadeFiliada = $entidadeFiliada;
        $this->matricula = $matricula;
        $this->nomePatrao = $nomePatrao;
    }

    // GETTERS

    public function getId(): ?int {
        return $this->id;
    }

    public function getDataEntrada(): DateTime {
        return $this->dataEntrada;
    }

    public function getValidade(): DateTime {
        return $this->validade;
    }

    public function getEntidadeFiliada(): string {
        return $this->entidadeFiliada;
    }

    public function getMatricula(): int {
        return $this->matricula;
    }

    public function getNomePatrao(): string {
        return $this->nomePatrao;
    }

    // SETTERS

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setDataEntrada(DateTime $dataEntrada): void {
        $this->dataEntrada = $dataEntrada;
    }

    public function setValidade(DateTime $validade): void {
        $this->validade = $validade;
    }

    public function setEntidadeFiliada(string $entidadeFiliada): void {
        $this->entidadeFiliada = $entidadeFiliada;
    }

    public function setMatricula(int $matricula): void {
        $this->matricula = $matricula;
    }

    public function setNomePatrao(string $nomePatrao): void {
        $this->nomePatrao = $nomePatrao;
    }
}