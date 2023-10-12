<?php include '../pauta/menu/bars.php';?>
<?php include '../_inc/headHTML.php';?>
<?php include '../_inc/header.php';?>
<?php include '../../config/db/connection.php';?>
<?php include '../../dao/pauta_dao.php';?>
<title>Pauta</title>

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

	<h1> </h1>

	<div class="table-responsive">
	<caption><h1 class="text-center">Pauta de Resultados</h1></caption>
		<table border="1" align="center">
			<tr>
				<th> Nome do Aluno </th>
				<?php
					$pauta_dao = new PautaDao();
					$result_disc = $pauta_dao->GetDistinctNameDisc();
					$init_cont = 0;
					$end_cont = 0;
					
					foreach ($result_disc as $value) {
						echo "<th>". $value["nome_disc"] . "</th>"; 
						$end_cont++;
					}
				?>
				<th> Obs. </th>
			</tr>

			<?php
				$list_disc = $pauta_dao->GetAll();
				foreach ($list_disc as $value) {
					?> 
						<tr> 
							<?php 
								if($init_cont == 0){ 
									echo "<td>" . $value["nome_aluno"] . "</td>";
									$nota_value = $pauta_dao->GetNota($value["id_aluno"]);

									foreach ($nota_value as $value) {

										if($value["nota"] >= 9.5){
											if($value["nota"] == 9.5){
												echo "<td class='text-primary'>" . substr(10.01, 0, 4) . "</td> ";  
											}else{
												echo "<td class='text-primary'>" . substr($value["nota"], 0, 4) . "</td> ";  
											}
										}else{
											echo "<td class='text-danger'>" . substr($value["nota"], 0, 3) . "</td> ";  
										}
									} 
								 } 
							?>
						</tr> 
					<?php
					$init_cont++;
					if($init_cont == $end_cont){
						$init_cont=0;
					}
				}
			?>
			
		</table>
	</div>
</main>
<?php include '../_inc/footer.php';?>
<?php include '../_inc/footHTML.php';?>