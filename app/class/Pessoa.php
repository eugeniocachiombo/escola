<?php

class Pessoa {
	
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $idade;
    private $genero;
    private $morada;
    
    public function GetId() {
        return $this->id;
    }

    public function SetId( $id ) {
        $this->id = $id;
    }

    public function GetNome() {
        return $this->nome;
    }

    public function SetNome(  $nome ) {
        $this->nome = $nome;
    }

    public function GetSenha() {
        return $this->senha;
    }

    public function SetSenha(  $senha ) {
        $this->senha = $senha;
    }

    public function GetEmail() {
        return $this->email;
    }

    public function SetEmail(  $email ) {
        $this->email = $email;
    }

    public function GetIdade() {
        return $this->idade;
    }

    public function SetIdade(  $idade ) {
        $this->idade = $idade;
    }

    public function GetGenero() {
        return $this->genero;
    }

    public function SetGenero(  $genero ) {
        $this->genero = $genero;
    }

    public function GetMorada() {
        return $this->morada;
    }

    public function SetMorada(  $morada ) {
        $this->morada = $morada;
    }
}

?>