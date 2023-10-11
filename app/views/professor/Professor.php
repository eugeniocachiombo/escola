<?php
	require_once '../Pessoa.php';
	class Professor extends Pessoa
	{
		
		public function lançarNota(){
			echo "O professor ".$this->getNome()." Lançará as notas em Breve";
		}
	}