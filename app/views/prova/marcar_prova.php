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
<title>Marcação de provas</title>

<main class="d-flex align-items-center">
	<div class="container ">

		<form class="mb-5" method="POST">
			<h1>!!!Marque aqui a sua prova!!!</h1>
			<input class="form-control" type="submit" name="marcarProva" value="Marcar Prova">
		</form>

		<?php
			
			$aluno = new Aluno();

			$aluno->SetId($_SESSION["id"]);
			$aluno->SetNome($_SESSION["nome"]);
			$aluno->SetEmail($_SESSION["email"]);
			$aluno->SetIdade($_SESSION["idade"]);
			$aluno->SetGenero($_SESSION["genero"]);
			$aluno->SetMorada($_SESSION["morada"]);
			$aluno->Registed();

			if (isSet($_POST["marcarProva"])) {?>

		<form method="POST">

			<div class="row">
				<div class=" d-table d-md-flex">
					<div class="col m-3">
						<input class="form-control" style="background:#068ccb; color: white; " type="text" readonly name="nome"
							value="<?php echo $aluno->GetNome()?>" placeholder="Aluno">
					</div>

					<div class="col m-3">
						<?php 
							$disciplina_dao = new DisciplinaDao();
							$result = $disciplina_dao->GetAll();
						?>

						<select required class="form-control" style="background:#068ccb; color: white;" name="id_disc">
							<option name="" id="">Selecione a disciplina...</option>
							<?php	
								foreach ($result as $value) {?>
									<option value="<?php echo $value["id_disc"]?>">
										<?php echo $value["nome_disc"]; ?>
									</option>
							<?php } ?>
						</select>
					</div>
					
					<div class="col m-3">
						<input class="form-control" style="background:#068ccb; color: white; " readonly type="text" name="data"
							value="<?php echo date("Y-m-d") ?>" placeholder="Data">
					</div>
				</div>
				
				<div class="d-table d-md-flex">
					<div class="col m-3">
						<input class="form-control" type="submit" name="marcado" value="Marcar">
					</div>

					<div class="col m-3">
						<input class="form-control" type="submit" name="" value="Cancelar">
					</div>
				</div>
			</div>

		</form>

		<?php	

			}	elseif (isSet($_POST["marcado"])) {

				$disciplina_dao = new DisciplinaDao();
				$result = $disciplina_dao->GetAllWithId($_POST["id_disc"]);
				
				$professor = new Professor();

				$professor->SetId($result["id_prof"]);
				$professor->SetNome($result["nome_prof"]);
				$professor->SetEmail($result["email_prof"]);
				$professor->SetIdade($result["idade_prof"]);
				$professor->SetGenero($result["genero_prof"]);
				$professor->SetMorada($result["morada_prof"]);

				$disciplina = new Disciplina($professor);

				$disciplina->SetId($result["id_disc"]);
				$disciplina->SetNomeDisciplina($result["nome_disc"]);

				$prova = new Prova($aluno, $disciplina);
				$prova->SetAceite(true);
				$prova->SetData($_POST["data"]);
				$prova->GetAluno()->SetRegisted(true);
						
				$marcar_prova_dao = new MarcarProvaDao();
				$result = $marcar_prova_dao->GetWithAlunoDisc($disciplina->GetId(), $aluno->GetId());

				if (empty($result["id_disc"]) && empty($result["id_aluno"])) {
						
						$prova_dao = new ProvaDao();
						$prova_dao->AgendTest($prova);
						
						if ($professor->GetGenero() != "M") {
							$_SESSION["prof"] = "Professora: ";
						} else{
							$_SESSION["prof"] = "Professor: ";
						}

						echo "<p align= 'center'>  ".$_SESSION["prof"] ." " .$professor->GetNome()."</p>";
						echo "<a href='marcar_prova.php' style='color:white; text-align: center'> Limpar </a>";

						$result = $marcar_prova_dao->Create($aluno->GetId(), $disciplina->GetId(), $professor->GetId());
						
						if($result){
							echo "<p align= 'center' style= 'background: green' > Prova marcada com sucesso </p>";
						}else{
							echo "<p align= 'center' style= 'background: red' > Erro ao marcar prova </p>";
						}
				} else{
						echo "<h2> <p align= 'center' style= 'background: red; color: white' >  Não é possível marcar esta prova, já existe prova marcada com essa disciplina   </p> </h2>";
						echo "<a href='marcar_prova.php' style='color:white; text-align: center'> Actualizar </a>";
				} 
			}
		?>
	</div>
</main>

<?php include '../_inc/footer.php';?>
<?php include '../_inc/footHTML.php';?>