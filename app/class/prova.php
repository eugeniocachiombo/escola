<?php

class Prova {
    private  $aluno;
    private  $disciplina;
    private  $nota;
    private  $data;
	private  $aceite;
	
	function __construct( $aluno, $disciplina )
    {
        $this->aluno = $aluno;
        $this->disciplina = $disciplina;
        $this->aceite = false;
        $this->nota = 0;
    }

    public function GetAluno() {
        return $this->aluno;
    }

    public function SetAluno( $aluno ) {
        $this->aluno = $aluno;
    }

    public function GetDisciplina() {
        return $this->disciplina;
    }

    public function SetDisciplina( $disciplina ) {
        $this->disciplina = $disciplina;
    }

    public function GetNota() {
        return $this->nota;
    }

    public function SetNota( $nota ) {
        $this->nota = $nota;
    }

    public function GetData() {
        return $this->data;
    }

    public function SetData( $data ) {
        $this->data = $data;
    }

    public function GetAceite() {
        return $this->aceite;
    }

    public function SetAceite( $aceite ) {
        $this->aceite = $aceite;
    }

}