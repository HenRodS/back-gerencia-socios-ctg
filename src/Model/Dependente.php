<?php
namespace Model;

use DateTime;
use JsonSerializable;

class Dependente implements JsonSerializable {

    private ?int $id;
    private int $socioTitularId;
    private string $nomeCompleto;
    private string $cpf;
    private string $telefone;
    private string $identidade;
    private string $endereco;
    private DateTime $dataNascimento;
    private DateTime $dataEntrada;
    private int $categoriaId;
    private bool $dancarino;
    private bool $pagaInstrutor;

    public function __construct(
        int $socioTitularId,
        string $nomeCompleto,
        string $cpf,
        string $telefone,
        string $identidade,
        string $endereco,
        DateTime $dataNascimento,
        DateTime $dataEntrada,
        int $categoriaId,
        bool $dancarino,
        bool $pagaInstrutor,
        ?int $id = null
    ){
        $this->id = $id;
        $this->socioTitularId = $socioTitularId;
        $this->nomeCompleto = $nomeCompleto;
        $this->cpf = $cpf;
        $this->telefone = $telefone;
        $this->identidade = $identidade;
        $this->endereco = $endereco;
        $this->dataNascimento = $dataNascimento;
        $this->dataEntrada = $dataEntrada;
        $this->categoriaId = $categoriaId;
        $this->dancarino = $dancarino;
        $this->pagaInstrutor = $pagaInstrutor;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getSocioTitularId(): int {
        return $this->socioTitularId;
    }

    public function getNomeCompleto(): string {
        return $this->nomeCompleto;
    }

    public function getCpf(): string {
        return $this->cpf;
    }

    public function getTelefone(): string {
        return $this->telefone;
    }

    public function getIdentidade(): string {
        return $this->identidade;
    }

    public function getEndereco(): string {
        return $this->endereco;
    }

    public function getDataNascimento(): DateTime {
        return $this->dataNascimento;
    }

    public function getDataEntrada(): DateTime {
        return $this->dataEntrada;
    }

    public function getCategoriaId(): int {
        return $this->categoriaId;
    }

    public function isDancarino(): bool {
        return $this->dancarino;
    }

    public function isPagaInstrutor(): bool {
        return $this->pagaInstrutor;
    }

    public function jsonSerialize(): array {
        return [
            'id' => $this->id,
            'socio_titular_id' => $this->socioTitularId,
            'nome_completo' => $this->nomeCompleto,
            'cpf' => $this->cpf,
            'telefone' => $this->telefone,
            'identidade' => $this->identidade,
            'endereco' => $this->endereco,
            'data_nascimento' => $this->dataNascimento->format('Y-m-d'),
            'data_entrada' => $this->dataEntrada->format('Y-m-d'),
            'categoria_id' => $this->categoriaId,
            'dancarino' => $this->dancarino,
            'paga_instrutor' => $this->pagaInstrutor
        ];
    }
}