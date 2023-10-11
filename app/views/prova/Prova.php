<?php
	
	require_once '../Aluno/Aluno.php';
	require_once '../Disciplina/Disciplina.php';
	include '../Conexao.php';

	$con = getConexao();
	//session_start();

	class Prova 
	{
		private Aluno $aluno;
		private Disciplina $disciplina;
		private float $nota;
		private String $data;
		private bool $aceite;

		public function getAluno(){
			return $this->aluno;
		}
		
		public function setAluno(Aluno $al){
			$this->aluno = $al;
		}

		public function getDisciplina(){
			return $this->disciplina;
		}
		
		public function setDisciplina(Disciplina $dis){
			$this->disciplina = $dis;
		}

		public function getNota(){
			return $this->nota;
		}
		
		public function setNota(float $no){
			$this->nota = $no;
		}

		public function getData(){
			return $this->data;
		}
		
		public function setData(String $dat){
			$this->data = $dat;
		}

		public function getAceite(){
			return $this->aceite;
		}
		
		public function setAceite(bool $ace){
			$this->aceite = $ace;
		}


		function __construct(Aluno $al, Disciplina $disciplina)
		{
			$this->aluno = $al;
			$this->disciplina = $disciplina;
			$this->aceite = false;
			$this->nota= 0;

		}

		public function marcarProva(){
		if ($this->aluno->getMatricula() == true) {
			//

			$genero = $this->aluno->getGenero();
			$alu;

			if ($genero != "Masculino") {
			
			
			$_SESSION["alu"] = "a aluna";

			
			} else{

			$_SESSION["alu"] = "o aluno";
			
			
			}

			$this->setAceite(true);
			$this->aluno->getNome();
			$this->disciplina->getProfessor();
			
			$this->data = date("d-m-y");

			

		
	echo "<p align= 'center'> Prova marcada, para data de: ".$this->getData()." com ".$_SESSION["alu"]." ".$this->aluno->getNome()." disciplina: ".$this->disciplina->getNomeDisciplina()."</p>";







		} else {

				echo "<fieldset>";
				echo "Impossível marcar a prova, não afetuou a matricula do aluno/a";
				echo "</fieldset>";
		}
			
		}

		public function Resultado(){

	
		if($this->getAceite() == true){

			$this->aluno->setMatricula(true);

			$con2 = getConexao();

			$sql = "select * from pauta where nomeAluno = ?"; 

			$stmt = $con2->prepare($sql);
			$stmt->bindValue(1, $this->aluno->getNome());
			$stmt->execute();
			$result = $stmt->fetchAll(); 

			$cont = 0;
			?>


			<table border="2" align="center">
				
				<tr align="center" bgcolor="#04b131">
					<th>Disciplinas</th>
					<th>Notas</th>
					<th>Transição</th>
					<th>Recurso</th>
				</tr>

				<?php	foreach ($result as $value) {

					
					?>
				<tr align="center" bgcolor="#004c14">
					<td><?php echo $value["disciplina"] ?> </td>

					<td><?php echo intval($value["nota"]) ?> </td>

				<td><?php $this->setNota($value["nota"]); $this->aprovar();?> </td>

				<form method="POST" action="Recurso.php">
				<input type="hidden" name="nomeAluno" value="<?php echo $_SESSION["nome"] ?>">
				<input type="hidden" name="disciplina" value="<?php echo $value["disciplina"] ?>">
				<input type="hidden" name="idPauta" value="<?php echo $value["idPauta"] ?>">
				<input type="hidden" name="nota" value="<?php echo $value["nota"] ?>">	
			<td> <input type="submit" name="recurso" value="Fazer Recurso"> </td>
				</form>
				<?php		
			$cont = $cont + 1;
			
			} 

			


			?>

				
			
			</tr>


			</table>

			<?php
		if ($cont == 0) {
		
			echo "<p style='color:white; background: blue' align='center'> Ainda não há notas lançadas do aluno/a ".$this->aluno->getNome()."</p>";
			} else{
				$this->media();
			}

		} else{

			echo "<fieldset>";
				echo "Impossível ver os resultados, não foi feito nenhuma prova";
				echo "</fieldset>";


		}

		}


			public function media(){

	
		if($this->getAceite() == true){

			$this->aluno->setMatricula(true);

			$con2 = getConexao();

			$sql = "select sum(nota), sum(cont)  from pauta where nomeAluno = ?";

			$stmt = $con2->prepare($sql);
			$stmt->bindValue(1, $this->aluno->getNome());
			$stmt->execute();
			$result = $stmt->fetchAll(); 
			?>


			<table border="2" align="center">
				
				<tr bgcolor="#004c14">
					<th>Média Final</th>
				

				<?php	foreach ($result as $value) {?>

				

				<?php		
				

				$nota = ($value["sum(nota)"])/($value["sum(cont)"]);

				$nota1 = number_format($nota, 2);
				} ?>
			<td bgcolor="#004c14" align="center"><?php echo "<label style='color: #24fe00'> ".$nota1."v </label>" ?></td>

			<td><?php 

			$this->setNota($nota1);
			$this->aprovarMedia();

			$notaFinal =  $this->getNota();

		$sql44 = "insert into media (idMedia, nomeAluno, mediaAluno) values(?, ?, ?)";
		$con44 = getConexao();
		$stmt44 = $con44->prepare($sql44);
		$stmt44->bindValue(1, $this->aluno->getId());
		$stmt44->bindValue(2, $this->aluno->getNome());
		$stmt44->bindValue(3, intval($notaFinal));
		
		$stmt44->execute();


		$sql45 = "Update media 
		set nomeAluno = ?, 
		mediaAluno=? where idMedia = ?";
		$con45 = getConexao();
		$stmt45 = $con45->prepare($sql45);
		$stmt45->bindValue(1, $this->aluno->getNome());
		$stmt45->bindValue(2, $this->getNota());
		$stmt45->bindValue(3, $this->aluno->getId());
		$stmt45->execute();


			?></td>
			</tr>
			</table>

			<?php
		

		} else{

			echo "<fieldset>";
				echo "Impossível ver os resultados, não foi feito nenhuma prova";
				echo "</fieldset>";


		}

		}
		

			public function aprovar(){

			if($this->aluno->getMatricula() == true){

			if ($this->getAceite() == true && $this->getNota() >= 14) {
				
		echo "<fieldset>";
	
		echo "<label style='color: #24fe00'> Dispensado </label>";

		echo "</fieldset>";	

			}

			elseif($this->getNota() >= 10) {
				echo "<fieldset>";	
		echo "<label style='color: #00d7fe'> Aprovado </label>";
			echo "</fieldset>";	
			} 
			elseif($this->getNota() >= 7) {
				echo "<fieldset>";	
		echo "<label style='color: #ff8585'> Melhoria de notas </label>";
			echo "</fieldset>";	
			} 

			else {
				echo "<fieldset>";	
		echo "<label style='color: #fd6652'> Reprovado </label>";
			echo "</fieldset>";	
			}

		} else{
			echo "<fieldset>";	
			echo "Precisa de ter provas feitas";
			echo "</fieldset>";	
		}
		}

		public function aprovarMedia(){

			if($this->aluno->getMatricula() == true){

			if ($this->getAceite() == true && $this->getNota() >= 9.5) {
				
		echo "<fieldset>";
	
		echo "<label style='color: #24fe00'> Aprovado </label>";

		echo "</fieldset>";	
			}

			else {
				echo "<fieldset>";	
		echo "<label style='color: #fd6652'> Reprovado </label>";
			echo "</fieldset>";	
			} 
			
		} }




		public function fazerProva(){
			if ($this->getAceite() == true) {

	echo "<fieldset>";			
	echo "<legend><h4> Prova autorizada </h4> </legend>";
	echo "<h5> Prova a decorrer . . . </h5> </br>";
	echo "<label>Aluno/a ".$this->aluno->getNome()." está em prova </label><br>";
	echo "<label>Fazendo prova de ***".$this->disciplina->getNomeDisciplina()."***</label><br>";
	echo "<label> Disciplina do/a professor/a: ";
		echo $this->disciplina->nomeProf()."</label>";
		echo "<br> Data: ".$this->data;
	//	echo "<br> Nota: ".$this->getNota()."v";
	echo "</fieldset>";

		

			} else {
				echo "<fieldset>";
				echo "Não foi marcada nenhuma prova";
				echo "</fieldset>";
			}
		}



	}