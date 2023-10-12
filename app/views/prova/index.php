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
<title>Opções de Provas</title>


<main>
	<div class="table-responsive mt-5">
		<?php
			if (isset($_POST["resultado"])) {
				
				$professor = new Professor();
				$disciplina = new Disciplina($professor);

				$aluno = new Aluno();
				$aluno->SetId($_SESSION["id"]);
				$aluno->SetNome($_SESSION["nome"]);

				$prova = new Prova($aluno, $disciplina);
				$prova_dao = new ProvaDao();

				$prova->SetAceite(true);
				$prova_dao->Result($prova);

				echo "<br><a href= 'FaceProva.php' style= 'color: white' > Limpar Registro </a><br> <br>";
			}
		?>
	</div>
	<form method="POST">
			<h1>Opções de Prova</h1> 
			<input type="submit" name="resultado" value="Resultado">
	</form>
</main>

<?php
	if (isset($_POST["terminar"])) {
		session_destroy();
		header("location:../Inicio/Login.php");
	}
?>


<?php include '../_inc/footer.php';?>
<?php include '../_inc/footHTML.php';?>