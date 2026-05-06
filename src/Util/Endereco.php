<?php
namespace Util;

use JsonSerializable;

class Endereco implements JsonSerializable
{
    private string $logradouro;
    private string $numero;
    private ?string $complemento;
    private string $bairro;
    private string $cidade;
    private string $estado;
    private string $cep;

    public function __construct(
        string $logradouro,
        string $numero,
        string $bairro,
        string $cidade,
        string $estado,
        string $cep,
        ?string $complemento = null
    ) {
        $this->logradouro = $logradouro;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->cep = $cep;
        $this->complemento = $complemento;
    }


    // GETTERS

    public function getLogradouro(): string {
        return $this->logradouro;
    }

    public function getNumero(): string {
        return $this->numero;
    }

    public function getComplemento(): ?string {
        return $this->complemento;
    }

    public function getBairro(): string {
        return $this->bairro;
    }

    public function getCidade(): string {
        return $this->cidade;
    }

    public function getEstado(): string {
        return $this->estado;
    }

    public function getCep(): string {
        return $this->cep;
    }


    // SETTERS

    public function setComplemento(?string $complemento): void {
        $this->complemento = $complemento;
    }


    // HELPERS

    public function getEnderecoCompleto(): string {
        return sprintf(
            '%s, %s%s - %s, %s/%s - CEP: %s',
            $this->logradouro,
            $this->numero,
            $this->complemento ? ' (' . $this->complemento . ')' : '',
            $this->bairro,
            $this->cidade,
            $this->estado,
            $this->cep
        );
    }


    // JSON

    public function jsonSerialize(): mixed {
        return [
            'logradouro' => $this->logradouro,
            'numero' => $this->numero,
            'complemento' => $this->complemento,
            'bairro' => $this->bairro,
            'cidade' => $this->cidade,
            'estado' => $this->estado,
            'cep' => $this->cep
        ];
    }
}