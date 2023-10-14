<?php include '../_inc/headHTML.php';?>
<?php include 'menu/bars.php';?>
<?php include '../_inc/header.php';?>
<?php include '../../config/db/connection.php';?>
<?php include '../../class/prova.php';?>
<?php include '../../class/aluno.php';?>
<?php include '../../class/professor.php';?>
<?php include '../../class/disciplina.php';?>
<?php include '../../dao/aluno_dao.php';?>
<?php include '../../dao/prova_dao.php';?>
<?php include '../../dao/prof_dao.php';?>
<?php include '../../dao/pauta_dao.php';?>
<?php include '../../dao/marcar_prova_dao.php';?>
<?php include '../../dao/disciplina_dao.php';?>
<title>Fazer prova</title>

<main class="d-flex align-items-center">
	<div class="container">
		<?php
	
	$aluno = new Aluno();

	$aluno->SetId($_SESSION["id"]);
	$aluno->SetNome($_SESSION["nome"]);
	$aluno->SetEmail($_SESSION["email"]);
	$aluno->SetIdade($_SESSION["idade"]);
	$aluno->SetGenero($_SESSION["genero"]);
	$aluno->SetMorada($_SESSION["morada"]);
	$aluno->Registed();

	$professor = new Professor();
	$disciplina = new Disciplina($professor);
	$prova = new Prova($aluno, $disciplina);

	if ($aluno->GetId()) {

		$marcar_prova_dao = new MarcarProvaDao();
		$result = $marcar_prova_dao->GetWithAluno($aluno->GetId()); 
		$cont = 0; ?>

		<h1>Provas Marcadas</h1>
		<hr>
		<div class="table-responsive">
			<table>
				<tr>
					<th>Nome do Aluno</th>
					<th>Nome da Disciplina</th>
					<th>Docente</th>
					<th>Opções</th>
				</tr>

				<tr>
					<?php
					foreach ($result as $value) {?>

					<td> <?php echo $aluno->GetNome(); ?></td>

					<?php
							$disciplina_dao = new DisciplinaDao();
							$result = $disciplina_dao->GetWithId($value["id_disc"]); 
						?>
					<td> <?php echo $result["nome_disc"] ?></td>

					<?php
							$professor_dao = new ProfessorDao();
							$result = $professor_dao->GetWithId( $value["id_prof"] ); 
						?>
					<td> <?php echo $result["nome_prof"] ?> </td>

					<td>
						<form method="POST" action="fazer_prova.php">
							<input type="hidden" name="id_disc" value="<?php echo $value["id_disc"] ?>">
							<input type="hidden" name="id_aluno" value="<?php echo $value["id_aluno"] ?> ">
							<input type="hidden" name="id_prof" value="<?php echo $value["id_prof"] ?>">
							<input type="hidden" name="id_marcar_prova" value="<?php echo $value["id_marcar_prova"] ?>">
							<input class="form-control" type="submit" name="comecar" value="Começar"> </a>
						</form>
						<?php	$cont++; ?>
					</td>
				</tr>
				<?php	} ?>
			</table>
		</div>

		<div class="pt-3">
			<?php
			if ($cont == 0) {
				$genero = $prova->GetAluno()->GetGenero();
				if ( $genero != 'M' ) {
					echo "<p style='color:white; background: blue' align='center'> Ainda não temos informações de provas marcadas pela aluna ".$aluno->GetNome()."</p>";	
				} else {
					echo "<p style='color:white; background: blue' align='center'> Ainda não temos informações de provas marcadas pelo aluno ".$aluno->GetNome()."</p>";
				}	
			} else if(isset($_POST["comecar"])){

					$disciplina_dao = new DisciplinaDao();
					$result = $disciplina_dao->GetWithId($_POST["id_disc"]);

					$disciplina->SetId($result["id_disc"]);
					$disciplina->SetNomeDisciplina($result["nome_disc"]);

					$professor_dao = new ProfessorDao();
					$result = $professor_dao->GetWithId( $_POST["id_prof"] ); 

					$professor->SetId($result["id_prof"]);
					$professor->SetNome($result["nome_prof"]);
					$professor->SetEmail($result["email_prof"]);
					$professor->SetIdade($result["idade_prof"]);
					$professor->SetGenero($result["genero_prof"]);
					$professor->SetMorada($result["morada_prof"]);
					
					$nota = rand(0,20);
					$prova->SetData(date("d-m-Y"));
					$prova->SetAceite(true);
					$prova->SetNota($nota);

					$pauta_dao = new PautaDao();
					$result = $pauta_dao->GetDiscAluno( $disciplina->GetId(), $aluno->GetId());
			
					if (empty($result["id_disc"]) && empty($result["id_aluno"])) {

						$pauta_dao = new PautaDao();
						$pauta_dao->Create($aluno->GetId(),  $disciplina->GetId(), $prova->GetNota());

						$prova_dao = new ProvaDao();
						$prova_dao->MakeTest($prova);

						$marcar_prova_dao = new MarcarProvaDao();
						$marcar_prova_dao->Delete($_POST["id_marcar_prova"]);

					} else{
						echo "<h2> <p align= 'center' style= 'background: red; color: white' >  A prova de ".$disciplina->GetNomeDisciplina()." já foi feita   </p> </h2>";
						echo "<a href='fazer_prova.php' style='color:white; text-align: center'> Actualizars </a>";
						$marcar_prova_dao = new MarcarProvaDao();
						$marcar_prova_dao->Delete($_POST["id_marcar_prova"]);
					}		
				}
			?>
		</div>

		<?php 
		} 
	?>
	</div>
</main>

<?php include '../_inc/footer.php';?>
<?php include '../_inc/footHTML.php';?>