<?php include '../_inc/headHTML.php';?>
<?php include '../melhor_classificado/menu/bars.php';?>
<?php include '../_inc/header.php';?>
<?php include '../../config/db/connection.php';?>
<?php include '../../dao/pauta_dao.php';?>
<?php include '../../dao/media_dao.php';?>
<title>Melhor Classificado</title>

<main>
	<div class="table-responsive mt-5">
	<caption><h1 class="text-center">Classificação</h1></caption>
		<table border="1" align="center">
			<tr>
				<th> Nome do Aluno </th>
				<th> Média do Aluno </th>
				<th> Obs. </th>
			</tr>

			
			<?php
				$media_dao = new MediaDao();
				$media_value = $media_dao->GetClassification();
				$cont = 1;
				foreach($media_value as $value){
					echo "<tr> 
					<td>" . $value["nome_aluno"] . "</td> 
					<td>" . $value["media_aluno"] . "</td> 
					<td class='text-primary'>" . $cont . "º</td> 
					</tr>";
					$cont++;
				}
			?>
			
			
		</table>
	</div>
</main>
<?php include '../_inc/footer.php';?>
<?php include '../_inc/footHTML.php';?>