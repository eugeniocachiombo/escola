<?php

class Pessoa {
	
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $idade;
    private $genero;
	private $morada;
	
	function __construct($id, $nome, $email, $idade, $genero, $morada) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->idade = $idade;
        $this->genero = $genero;
        $this->morada = $morada;
    }

    public function GetId() {
        return $this->id;
    }

    public function SetId( int $id ) {
        $this->id = $id;
    }

    public function GetNome() {
        return $this->nome;
    }

    public function SetNome( String $nome ) {
        $this->nome = $nome;
    }

    public function GetSenha() {
        return $this->senha;
    }

    public function SetSenha( String $senha ) {
        $this->senha = $senha;
    }

    public function GetEmail() {
        return $this->email;
    }

    public function SetEmail( String $email ) {
        $this->email = $email;
    }

    public function GetIdade() {
        return $this->idade;
    }

    public function SetIdade( int $idade ) {
        $this->idade = $idade;
    }

    public function GetGenero() {
        return $this->genero;
    }

    public function SetGenero( String $genero ) {
        $this->genero = $genero;
    }

    public function GetMorada() {
        return $this->morada;
    }

    public function SetMorada( String $morada ) {
        $this->morada = $morada;
    }
}

?>