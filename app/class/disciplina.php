<?php
require_once 'professor.php';

class Disciplina {
    private $id;
    private $nome_disciplina;
    private $professor;

    function __construct( $professor ) {
        $this->professor = $professor;
    }

    public function GetNome_Disciplina() {
        return $this->nome_disciplina;
    }

    public function SetNome_Disciplina( String $nome_disciplina ) {
        $this->nome_disciplina = $nome_disciplina;
    }

    public function GetProfessor() {
        return $this->professor;
    }

    public function SetProfessor( Professor $professor ) {
        $this->professor = $professor;
    }

    function NameTeacher() {
        echo $this->professor->GetNome();
    }
}