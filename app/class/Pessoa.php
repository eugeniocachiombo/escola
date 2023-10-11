<?php

	
	abstract class Pessoa
	{
		private $id;
		private $nome;
		private $idade;
		private $genero;
		private $morada;

		public function getId(){
			return $this->id;
		}
		
		public function setId(int $i){
			$this->id = $i;
		}

		public function getNome(){
			return $this->nome;
		}
		
		public function setNome(String $nom){
			$this->nome = $nom;
		}

		public function getIdade(){
			return $this->idade;
		}
		
		public function setIdade(int $ida){
			$this->idade = $ida;
		}

		public function getGenero(){
			return $this->genero;
		}
		
		public function setGenero(String $ge){
			$this->genero = $ge;
		}

		public function getMorada(){
			return $this->morada;
		}
		
		public function setMorada(String $mora){
			$this->morada = $mora;
		}
	}










?>