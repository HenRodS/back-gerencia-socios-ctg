<?php
namespace Model;

use DateTime;
use Util\Endereco;
use Util\CategoriaSocio;

class Dependente {

    private ?int $id;
    private int $socioTitularId;
    private string $nome;
    private string $cpf;
    private string $telefone;
    private string $foto;
    private string $identidade;
    private Endereco $endereco;
    private DateTime $dataNascimento;
    private DateTime $dataEntrada;
    private CategoriaSocio $categoria;
    private bool $dancarino;
    private bool $pagaInstrutor;

    private ?CartaoTrad $cartaoTrad = null;

    public function __construct(
        int $socioTitularId,
        string $nome,
        string $cpf,
        string $telefone,
        string $foto,
        string $identidade,
        Endereco $endereco,
        DateTime $dataNascimento,
        DateTime $dataEntrada,
        CategoriaSocio $categoria,
        bool $dancarino,
        bool $pagaInstrutor,
        ?int $id = null,
        ?CartaoTrad $cartaoTrad = null
    ){
        $this->id = $id;
        $this->socioTitularId = $socioTitularId;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->telefone = $telefone;
        $this->foto = $foto;
        $this->identidade = $identidade;
        $this->endereco = $endereco;
        $this->dataNascimento = $dataNascimento;
        $this->dataEntrada = $dataEntrada;
        $this->categoria = $categoria;
        $this->dancarino = $dancarino;
        $this->pagaInstrutor = $pagaInstrutor;
        $this->cartaoTrad = $cartaoTrad;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getSocioTitularId(): int {
        return $this->socioTitularId;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getCpf(): string {
        return $this->cpf;
    }

    public function getTelefone(): string {
        return $this->telefone;
    }

    public function getFoto(): string {
        return $this->foto;
    }

    public function getIdentidade(): string {
        return $this->identidade;
    }

    public function getEndereco(): Endereco {
        return $this->endereco;
    }

    public function getDataNascimento(): DateTime {
        return $this->dataNascimento;
    }

    public function getDataEntrada(): DateTime {
        return $this->dataEntrada;
    }

    public function getCategoria(): CategoriaSocio {
        return $this->categoria;
    }

    public function isDancarino(): bool {
        return $this->dancarino;
    }

    public function isPagaInstrutor(): bool {
        return $this->pagaInstrutor;
    }

    public function getCartaoTrad(): ?CartaoTrad {
        return $this->cartaoTrad;
    }

    public function setEndereco(Endereco $endereco): void {
        $this->endereco = $endereco;
    }

    public function setCategoria(CategoriaSocio $categoria): void {
        $this->categoria = $categoria;
    }

    public function setCartaoTrad(?CartaoTrad $cartaoTrad): void {
        $this->cartaoTrad = $cartaoTrad;
    }
}