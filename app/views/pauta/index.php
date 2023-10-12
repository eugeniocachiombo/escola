<?php include '../inicio/menu/bars.php';?>
<?php include '../_inc/headHTML.php';?>
<?php include '../_inc/header.php';?>
<?php include '../../config/db/connection.php';?>
<title>Pauta</title>

	<style type="text/css">
		table {
			width: 100%;
			text-align: center;
		}

		th {
			min-width: 150px;
			border: 1px solid;
		}

		#pad {
			padding: 1px;
			display: block;
		}

		#p {
			text-align: right;
		}

		th {
			background: #04b131;
		}

		#a {
			background: gray;
		}

		#positiva {
			background: #0054fe;
		}

		#negativa {
			background: #fe0000;
		}

		#posinota {
			background: #04b131;
			color: white;
		}

		#neganota {
			background: #717171;
			color: #f85151;
		}

		#c {
			background: gray;
		}

		#a1 {
			background: #04b131;
			color: white;
		}

		#a2 {
			background: #06912a;
			color: white;
		}

		#a3 {
			background: #047922;
			color: white;
		}


		#a4 {
			background: #004c14;
			color: white;
		}
	</style>



	<main>
	<center>
		<a href="Vermelhor.php" style="background: green; color: white;">Ver Melhor Classificação</a>
	</center> <br>

	<center>
		<a href="Reprovados.php" style="background: green; color: white;">Reprovados </a>
	</center> <br>

	<center>
		<a href="Página Inicial.php" style="background: green; color: white;">
			Página Inicial
		</a>
	</center><br>

	<div class="table-responsive">
		<table border="1" align="center">
			<tr id="cab">
				<th> Nome do Aluno </th>
				
				<?php

					$con = GetConnection();
					$sql_disc = "select distinct nome_disc from pauta 
					left outer join aluno
					on pauta.id_aluno = aluno.id_aluno
					left outer join disciplina
					on pauta.id_disc = disciplina.id_disc ";
					$stmt_disc = $con->prepare($sql_disc);
					$stmt_disc->execute();
					$result_disc = $stmt_disc->fetchAll();
					$nome_disc_save = array();
					$end_cont = 0;
					
					foreach ($result_disc as $value) {
						?> 
							<th> 
								<?php  echo $value["nome_disc"]; ?> 
							</th> 
						<?php
						array_push($nome_disc_save, $value["nome_disc"]);
						$end_cont++;
					}
				?>
			</tr>

			<?php
				$sql_disc = "select * from pauta 
				left outer join aluno
				on pauta.id_aluno = aluno.id_aluno
				left outer join disciplina
				on pauta.id_disc = disciplina.id_disc order by nome_aluno asc";
				$stmt_disc = $con->prepare($sql_disc);
				$stmt_disc->execute();
				$result_disc = $stmt_disc->fetchAll();
				$cont = 0;
				
				foreach ($result_disc as $value) {
					?> 
						<tr> 
							<?php if($cont == 0){ ?>
								<td> <?php  echo $value["id_aluno"] . ": " . $value["nome_aluno"]; ?> </td>
								 
								 <?php
									$sql_disc = "select nota from pauta where id_aluno = ?";
									$stmt_disc = $con->prepare($sql_disc);
									$stmt_disc->bindValue(1, $value["id_aluno"]);
									$stmt_disc->execute();
									$result_disc = $stmt_disc->fetchAll();
								 ?>
									<?php foreach ($result_disc as $value) { ?>
										<td > <?php  echo $value["nota"]; ?> </td> 
									<?php } ?>
							<?php } ?>
						</tr> 
					<?php
					$cont++;
					if($cont == $end_cont){$cont=0;}
				}
				
			?>
			
		</table>
	</div>
	</main>
<?php include '../_inc/footer.php';?>
<?php include '../_inc/footHTML.php';?>