<?php
require_once 'professor.php';

class Disciplina {
    private $id;
    private $nome_disciplina;
    private $professor;

    function __construct( $professor ) {
        $this->professor = $professor;
    }

    public function GetId() {
        return $this->id;
    }

    public function SetId( $id ) {
        $this->id = $id;
    }

    public function GetNomeDisciplina() {
        return $this->nome_disciplina;
    }

    public function SetNomeDisciplina( $nome_disciplina ) {
        $this->nome_disciplina = $nome_disciplina;
    }

    public function GetProfessor() {
        return $this->professor;
    }

    public function SetProfessor(  $professor ) {
        $this->professor = $professor;
    }
}