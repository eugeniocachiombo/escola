<?php
require_once 'pessoa.php';

class Aluno extends Pessoa {
	
	private $matricula;

    public function __construct() {
        $this->matricula = false;
    }

    public function GetRegisted() {
        return $this->matricula;
    }

    public function SetRegisted( $matricula ) {
        $this->matricula = $matricula;
    }

    public function Registed() {
        $this->matricula = true;
    }

    public function NotRegisted() {
        $this->matricula = false;
    }
}