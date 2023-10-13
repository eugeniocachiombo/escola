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

	$con = GetConnection();
	$sql = "select * from marcar_prova where id_aluno = ?";
	$stmt = $con->prepare($sql);
	$stmt->bindValue(1, $aluno->GetId());
	$stmt->execute();
	$result = $stmt->fetchAll(); 
	$cont = 0; 
	?>

	<h1>Provas Marcadas</h1> <hr>
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

						<td><?php echo $aluno->GetNome() ?></td>

						<?php
						$sql = "select * from disciplina where id_disc = ?";
						$stmt = $con->prepare($sql);
						$stmt->bindValue(1, $value["id_disc"]);
						$stmt->execute();
						$result = $stmt->fetch(); ?>
						<td><?php echo $result["nome_disc"] ?></td>

						<?php
						$sql = "select * from professor where id_prof = ?";
						$stmt = $con->prepare($sql);
						$stmt->bindValue(1, $value["id_prof"]);
						$stmt->execute();
						$result = $stmt->fetch(); ?>
						<td><?php echo $result["nome_prof"] ?> </td>

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
			} elseif(isset($_POST["comecar"])){

					$sql = "select * from disciplina where id_disc = ?";
					$stmt = $con->prepare($sql);
					$stmt->bindValue(1, $_POST["id_disc"]);
					$stmt->execute();
					$dates = $stmt->fetch();
					$disciplina->SetId($dates["id_disc"]);
					$disciplina->SetNomeDisciplina($dates["nome_disc"]);

					$sql = "select * from professor where id_prof = ?";
					$stmt = $con->prepare($sql);
					$stmt->bindValue(1, $_POST["id_prof"]);
					$stmt->execute();
					$dates = $stmt->fetch();
					$professor->SetId($dates["id_prof"]);
					$professor->SetNome($dates["nome_prof"]);
					$professor->SetEmail($dates["email_prof"]);
					$professor->SetIdade($dates["idade_prof"]);
					$professor->SetGenero($dates["genero_prof"]);
					$professor->SetMorada($dates["morada_prof"]);
					
					$nota = rand(0,20);
					$prova->SetData(date("d-m-y"));
					$prova->SetAceite(true);
					$prova->SetNota($nota);
					
					$select = "select * from pauta 
					where id_disc= ? and id_aluno = ?";

					$stmt = $con->prepare($select);
					$stmt->bindValue(1, $disciplina->GetId());
					$stmt->bindValue(2, $aluno->GetId());
					$stmt->execute();
					$result = $stmt->fetch();
			
					if (empty($result["id_disc"]) && empty($result["id_aluno"])) {
								
							$sql = "insert into pauta (id_aluno, id_disc, nota) values (?, ?, ?) ";
							$stmt= $con->prepare($sql);
							$stmt->bindValue(1, $aluno->GetId());
							$stmt->bindValue(2, $disciplina->GetId());
							$stmt->bindValue(3, $prova->GetNota());
							$stmt->execute();

							$prova_dao = new ProvaDao();
							$prova_dao->MakeTest($prova);

							$id = $_POST["id_marcar_prova"];
							$sql = "delete from marcar_prova 
							where id_marcar_prova = ?";
							$stmt = $con->prepare($sql);
							$stmt->bindValue(1, $id);
							$stmt->execute();

					} else{
						echo "<h2> <p align= 'center' style= 'background: red; color: white' >  A prova de ".$disciplina->GetNomeDisciplina()." já foi feita   </p> </h2>";
						echo "<a href='fazer_prova.php' style='color:white; text-align: center'> Limpar </a>";
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