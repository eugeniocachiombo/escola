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
<title>Recurso e Melhoria</title>

<main class="d-flex justify-content-center">
	<div class="container">
		<?php
		if (isset($_POST["resultado"])) {

			$aluno = new Aluno();
			$professor = new Professor();
			$disciplina = new Disciplina($professor);

			$prova = new Prova($aluno, $disciplina);

			$nome = $_SESSION["nome"];
			$id = $_SESSION["id"];

			$prova->setAceite(true);
			$aluno->setNome($nome);
			$aluno->setId($id);
			$prova->Resultado();

			echo "<br><a href= 'index.php' style= 'color: white' > Limpar Registro </a><br> <br>";
		}

		$id_aluno = $_POST["id_aluno"];
		$id_disc = $_POST["id_disc"];
		$nome_disc = $_POST["nome_disc"];
		$id_pauta = $_POST["id_pauta"];
		$nota = $_POST["nota"];
	?>

		<form method="POST">
			<p align='center' style='color: white;'>
				<h4> Recuperação de nota, disciplina: <?php echo $nome_disc; ?></h4>
			</p>
			<input type="hidden" readonly name="id_aluno" value="<?php echo $id_aluno ?>">
			<input type="hidden" readonly name="id_pauta" value="<?php echo $id_pauta ?>">
			<input type="hidden" readonly name="id_disc" value="<?php echo $id_disc ?>">
			<input type="hidden" readonly name="nome_disc" value="<?php echo $nome_disc ?>">
			<input type="hidden" readonly name="nota" value="<?php echo $nota ?>">
			<input type="submit" class="form-control" name="fazer_melhoria" value="Fazer Melhoria/Recurso">
		</form>

		<div class="pt-3">
			<?php

		if (isset($_POST["fazer_melhoria"])) {

			$converted = intval($nota); 
			
			if ($converted <= 13 && $converted >= 8) {
			
				echo "<p align= 'center' style= 'background: green; color: white' > Melhoria feito com sucesso, disciplina: '****".$nome_disc."****'</p>"; 

				$pauta_dao = new PautaDao();
				$new_nota = $nota + rand(0, 7);
				$pauta_dao->Update($id_aluno,  $id_disc, $new_nota, $id_pauta);

			} elseif ($converted <= 7) {
			
				echo "<p align= 'center' style= 'background: green; color: white' > Recurso feito com sucesso, disciplina '****".$nome_disc."****'</p>"; 

				$pauta_dao = new PautaDao();
				$new_nota = $nota + rand(0, 13);
				$pauta_dao->Update($id_aluno,  $id_disc, $new_nota, $id_pauta);

			} else {
				echo "<p align= 'center' style= 'background: red; color: white' > Impossível fazer Recurso, a disciplina '****".$nome_disc."****' já foi dispensada</p>"; 
			}
		}

		?>
		</div>
	</div>
</main>

<?php include '../_inc/footer.php';?>
<?php include '../_inc/footHTML.php';?>