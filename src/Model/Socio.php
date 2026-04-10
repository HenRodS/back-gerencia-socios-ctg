<?php

class Socio{

    private ?int $id;
    private string $nome;
    private string $cpf;
    private string $telefone;
    private string $foto;
    private string $identidade;
    private string $endereco;
    private DateTime $dataNascimento;
    private DateTime $dataEntrada;
    private StatusSocio $status; //ENUM => CRIAR
    private int $categoriaId;
    private bool $dancarino;
    private bool $pagaInstrutor;

    public function __construct(string $nome, string $cpf, string $telefone,string $foto,string $identidade, string $endereco, DateTime $dataNascimento, DateTime $dataEntrada,StatusSocio $status,int $categoriaId, bool $dancarino, bool $pagaInstrutor,?int $id=null){
        $this->id = $id;
        $this -> nome = $nome;
        $this -> cpf = $cpf;
        $this -> telefone = $telefone;
        $this -> foto = $foto;
        $this -> identidade = $identidade;
        $this -> endereco = $endereco;
        $this -> dataNascimento = $dataNascimento;
        $this -> dataEntrada = $dataEntrada;
        $this -> status = $status;
        $this -> categoriaId = $categoriaId; 
        $this -> dancarino = $dancarino; 
        $this -> pagaInstrutor = $pagaInstrutor;
    }
}

?>