<?php include '../_inc/headHTML.php';?>
<?php include '../pauta/menu/bars.php';?>
<?php include '../_inc/header.php';?>
<?php include '../../config/db/connection.php';?>
<?php include '../../dao/pauta_dao.php';?>
<?php include '../../dao/media_dao.php';?>
<?php include '../../dao/disciplina_dao.php';?>
<title>Pauta</title>

<main>
	<div class="table-responsive mt-5">
	<caption><h1 class="text-center">Pauta de Resultados</h1></caption>
		<table border="1" align="center">
			<tr>
				<th> Nome do Aluno </th>
				<?php
					$pauta_dao = new PautaDao();
					$result_disc = $pauta_dao->GetDistinctNameDisc();
					$init_cont = 0;
					$end_cont = 0;
					$cont_disc = 0;
					
					foreach ($result_disc as $value) {
						echo "<th>". $value["nome_disc"] . "</th>"; 
						$end_cont++;
					}
				?>
				<th> Média Final </th>
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

									$media_dao = new MediaDao();
									$media_value = $media_dao->GetMediaId($value["id_aluno"]);

									$disciplina_dao = new DisciplinaDao();
									$result = $disciplina_dao->GetTotal();

									for ($i=0; $i < $result["count(*)"]; $i++) { 
									
										if(empty($nota_value[$i]["nota"]) ) {

											echo "<td> ------- </td> ";
										
										} else  {
											if($nota_value[$i]["nota"] >= 9.5){

												if($nota_value[$i]["nota"] == 9.5){
	
													echo "<td class='text-primary'>" . substr(10.01, 0, 4) . "</td> ";
	
												}else{
	
													echo "<td class='text-primary'>" . substr($nota_value[$i]["nota"], 0, 4) . "</td> ";  
												
												}
	
											} else if($nota_value[$i]["nota"] <= 9.4) {
	
												echo "<td class='text-danger'>" . substr($nota_value[$i]["nota"], 0, 3) . "</td> ";  
											
											} 
											$cont_disc = $i + 1;
										}
										
									}
									
									
									if($media_value["media_aluno"] >= 9.5 && $cont_disc == $result["count(*)"]){
										echo "<td class='text-success'> ".round($media_value["media_aluno"])." </td> ";  
										echo "<td class='text-success'> Aprovado </td> ";  
									} else if($media_value["media_aluno"] <= 9.4 && $cont_disc == $result["count(*)"]) {
										echo "<td class='text-danger'> ".round($media_value["media_aluno"])." </td> ";
										echo "<td class='text-danger'> Reprovado </td> ";
									} else {
										echo "<td class='text-danger'> ----- </td> ";
										echo "<td class='text-danger'> Consultar Secretaria </td> ";
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