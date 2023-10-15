<?php include '../_inc/headHTML.php';?>
<?php include 'menu/bars.php';?>
<?php include '../_inc/header.php';?>
<?php include '../../config/db/connection.php';?>
<?php include '../../class/professor.php';?>
<?php include '../../class/disciplina.php';?>
<?php include '../../dao/prof_dao.php';?>
<?php include '../../dao/disciplina_dao.php';?>
<title>Cadastrar Disciplina</title>



<main class="d-flex align-items-center">
	<div class="container ">
		<form method="POST">

			<div>
				<?php
					if (isset($_POST["cadastrar"])) {
						
						$nome_disc = $_POST["nome_disc"];
						$id_prof = $_POST["id_prof"];

						$disc_dao = new DisciplinaDao();

						if( $disc_dao->GetWithName($nome_disc) ){

							echo "<p align= 'center' style= 'background: red; color: white' >Já existe uma Disciplina com este nome </p>";

						}else{

							if ( $disc_dao->Create( $nome_disc, $id_prof ) ) {
								echo "<p align= 'center' style= 'background: green; color: white' > Cadastrado com sucesso </p>";
							} else{
								echo "<p align= 'center' style= 'background: red; color: white' > Erro!!! ao cadastrar </p>";
							}
						}
					}
				?>
			</div>

			<div>
				<h1>Cadastrar Disciplina</h1> <hr>
			</div>

			<div class="row">
				<div class=" d-table d-md-flex">

					<div class="col m-3">
						<label> Nome da disciplina:</label>
						<input class="form-control" type="text" name="nome_disc">
					</div>

					<div class="col m-3">
						<label>Nome do Professor:</label>

						<?php 
							$prof_dao = new ProfessorDao();
							$result = $prof_dao->GetIdProfNomeProf();
						?>

						<select class="form-control col " name="id_prof" id="select_prof">
							<option>Selecione...</option>
							<?php 
							foreach ($result as $value) {?>

							<option value="<?php  echo $value['id_prof']; ?>">
								<?php  echo $value['nome_prof']; ?>
							</option>

							<?php 
							}
						?>
						</select>
					</div>

				</div>

				<div class="d-table d-md-flex">
					<div class="col m-3">
						<input class="form-control" type="submit" name="cadastrar" value="Cadastrar">
					</div>
					
					<div class="col m-3">
						<a href="index.php"><input class="form-control" type="button" value="Ver Disciplinas"></a>
					</div>
				</div>
			</div>
		</form>
	</div>
</main>

<?php include '../_inc/footer.php';?>
<?php include '../_inc/footHTML.php';?>