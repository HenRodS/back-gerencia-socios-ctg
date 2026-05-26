<?php

namespace Model;

use JsonSerializable;

class Categoria implements JsonSerializable {

    private ?int $id;
    private string $nome;
    private float $valorSociedade;
    private float $valorInstrutor;

    public function __construct(
        string $nome,
        float $valorSociedade,
        float $valorInstrutor,
        ?int $id = null
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->valorSociedade = $valorSociedade;
        $this->valorInstrutor = $valorInstrutor;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getValorSociedade(): float {
        return $this->valorSociedade;
    }

    public function getValorInstrutor(): float {
        return $this->valorInstrutor;
    }

    public function setNome(string $nome): void {
        $this->nome = $nome;
    }

    public function setValorSociedade(float $valorSociedade): void {
        $this->valorSociedade = $valorSociedade;
    }

    public function setValorInstrutor(float $valorInstrutor): void {
        $this->valorInstrutor = $valorInstrutor;
    }

    public function jsonSerialize(): mixed {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'valor_sociedade' => $this->valorSociedade,
            'valor_instrutor' => $this->valorInstrutor
        ];
    }
}
