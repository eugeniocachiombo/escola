<?php include '../_inc/headHTML.php';?>
<?php include 'menu/bars.php';?>
<?php include '../_inc/header.php';?>
<?php include '../../config/db/connection.php';?>
<?php include '../../dao/disciplina_dao.php';?>
<title>Disciplinas</title>

<main class="d-flex justify-content-center pt-4">
	<div class="container">
		<div>
				Total de disciplinas e respectivos professores da Escola Cachiombo <hr>
		</div>

		<?php

		$disc_dao = new DisciplinaDao();
		$result = $disc_dao->GetAll();?>

		<div class="table-responsive">
			<table border="1" align="center">
				<tr>
					<th> Disciplina </th>
					<th> Professor </th>
				</tr>

				<?php	
					foreach ($result as $value) { 
						echo "<tr>";
							echo "<td>" .  $value["nome_disc"] . "</td>";
							echo "<td>" .  $value["nome_prof"] . "</td>";
						echo "</tr>";
					}
				?>

			</table>
		</div>		
	</div>
</main>

<?php include '../_inc/footer.php';?>
<?php include '../_inc/footHTML.php';?>