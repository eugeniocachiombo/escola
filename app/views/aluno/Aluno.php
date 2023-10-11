<?php
	require_once '../Pessoa.php';


	class Aluno extends Pessoa{

		private bool $matricula;

		public function getMatricula(){
			return $this->matricula;
		}
		
		public function setMatricula(bool $mat){
			$this->matricula = $mat;
		}

		public function matriculado(){
			$this->matricula = true;
		}

		public function nãoMatriculado(){
			$this->matricula = false;
		}

		public function __construct(){
			$this->matricula = false;
		}

		public function verPauta(){
			if ($this->getMatricula() == true) {
				
				$this->matriculado();
			} else {
				
				$this->nãoMatriculado();

			}
		}

		public function exibirDados(){

		echo "<legend align = 'center' > Dado do Aluno </legend>";
		
		echo "Nome: ".$this->getNome()."<br>";
		echo "Idade: ".$this->getIdade()." anos<br>";
		echo "Gênero: ".$this->getGenero()."<br>";
		echo "Morada: ".$this->getMorada()."<br>";
		}

	}