<?php
	require_once '../Professor/Professor.php';
	class Disciplina
	{
		private int $id;
		private String $nomeDisciplina;
		private Professor $professor;

		public function getNomeDisciplina(){
			return $this->nomeDisciplina;
		}
		
		public function setNomeDisciplina(String $ds){
			$this->nomeDisciplina = $ds;
		}

		public function getProfessor(){
			return $this->professor;
		}
		
		public function setProfessor(Professor $professor){
			$this->professor = $professor;
		}
		
		function __construct(Professor $professor)
		{	
			$this->professor = $professor;
		}


		function nomeProf(){
		echo	$this->professor->getNome();
		}
	}