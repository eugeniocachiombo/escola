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

					<input style="background:#068ccb; color: white; " type="text" readonly name="nome"
						value="<?php echo $aluno->GetNome()?>" placeholder="Aluno">

					<?php 
						$con = GetConnection();
						$sql = "select * from disciplina 
								inner join professor 
								On disciplina.id_prof = professor.id_prof";
						$stmt = $con->prepare($sql);
						$stmt->execute();
						$result = $stmt->fetchAll();?>

					<select style="background:#068ccb; color: white;" name="id_disc">

						<?php	foreach ($result as $value) {?>

						<option value="<?php echo $value["id_disc"]?>"><?php echo $value["nome_disc"]; } ?>

						</option>

					</select>

					<input style="background:#068ccb; color: white; " readonly type="text" name="data"
						value="<?php echo date("Y-m-d") ?>" placeholder="Data">
					<input type="submit" name="marcado" value="Marcar">
					<input type="submit" name="" value="Cancelar">

				</form>

			<?php	

			}	elseif (isSet($_POST["marcado"])) {

				$id_disc = $_POST["id_disc"];

				$sql = "select * from disciplina 
				inner join professor 
				On disciplina.id_prof = professor.id_prof
				where id_disc = ? ";
				$con = GetConnection();
				$stmt = $con->prepare($sql);
				$stmt->bindValue(1, $id_disc);
				$stmt->execute();
				$dates = $stmt->fetch();
				
				$professor = new Professor();
				$professor->SetId($dates["id_prof"]);
				$professor->SetNome($dates["nome_prof"]);
				$professor->SetEmail($dates["email_prof"]);
				$professor->SetIdade($dates["idade_prof"]);
				$professor->SetGenero($dates["genero_prof"]);
				$professor->SetMorada($dates["morada_prof"]);

				$disciplina = new Disciplina($professor);
				$disciplina->SetId($dates["id_disc"]);
				$disciplina->SetNomeDisciplina($dates["nome_disc"]);

				$prova = new Prova($aluno, $disciplina);
				$prova->SetAceite(true);
				$prova->SetData($_POST["data"]);
				$prova->GetAluno()->SetRegisted(true);
						
				$sql = "select * from marcar_prova 
				where id_disc = ? and id_aluno = ?";
				$stmt = $con->prepare($sql);
				$stmt->bindValue(1, $disciplina->GetId());
				$stmt->bindValue(2, $aluno->GetId());
				$stmt->execute();
				$result = $stmt->fetch();


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

						$sql = "insert into marcar_prova (id_aluno, id_disc, id_prof) values(?, ?, ?)";

						$stmt = $con->prepare($sql);
						$stmt->bindValue(1, $aluno->GetId());
						$stmt->bindValue(2, $disciplina->GetId());
						$stmt->bindValue(3, $professor->GetId());
						
						if($stmt->execute()){
							echo "<p align= 'center' style= 'background: green' > Prova marcada com sucesso </p>";
						}else{
							echo "<p align= 'center' style= 'background: red' > Erro ao marcar prova </p>";
						}
				} else{
						echo "<h2> <p align= 'center' style= 'background: red; color: white' >  Não é possível marcar esta prova, já existe prova marcada com essa disciplina   </p> </h2>";
						echo "<a href='marcar_prova.php' style='color:white; text-align: center'> Limpar </a>";
				} 
			}
		?>
	</div>
</main>


<?php include '../_inc/footer.php';?>
<?php include '../_inc/footHTML.php';?>