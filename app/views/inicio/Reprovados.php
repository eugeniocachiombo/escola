<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Login</title>
	<meta charset="utf-8">
	<style type="text/css">
		table{
			width: 100%;
			text-align: center;
		}
		body{
			color: white;
			background: gray;
		}

		#Cabeçario{
			background-size: cover;
			background: #068ccb;
			color: white;
			text-align: center;
		}

		#corpo{
			/*background: #c9d5db;*/
			color: white;
			text-align: center;
		}

		footer{
			background: #068ccb;
			color: white;
		}

		#image{
			width: 20%
		}
		#campo{
			background: green;
			color: white;
		}
		
		#pad{
			padding: 1px;
			display: block;
		}

			th{
			background: #04b131;
		}

		td{
			background: #717171;
		}

		#posinota{
			background: #04b131;
			color: white;
		}

		#posinota2{
			background: #06912a;
			color: white;
		}

		#posinota3{
			background: #047922;
			color: white;
		}


		#posinota4{
			background: #004c14;
			color: white;
		}

		#neganota{
			background: #717171;
			color: #f85151;
		}
	</style>
</head>
<body>

	<center>
	<a href="Vermelhor.php" style="background: green; color: white;">Ver Melhor Classificação</a>
	</center> <br>

	<center>
	<a href="Verpauta.php" style="background: green; color: white;">Ver Pauta </a>
	</center> <br>

	<center>
	<a  href="Página Inicial.php" style="background: green; color: white;">
	Página Inicial
	</a>
	</center><br>

		<?php
		include '../Conexao.php';

		$con = getConexao();

		$sql = "select * from media where  mediaAluno <= 9.4 order by mediaAluno desc";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$cont = 0;

		?>


		<table border="1" align="center">
				<tr id="cab">
				<th> Nome do Aluno </th>
				<th> Média </th>
				<th> Classificação </th>
				</tr>

	<?php	foreach ($result as $value) { ?>
 
				
		<tr>
		
		<?php $cont = $cont + 1;     


		if ($cont == 1) {?>
			<td id="posinota"> <?php echo  $value["nomeAluno"]?> </td>
			<td id="neganota"> <?php echo number_format($value["mediaAluno"], 1) ?> </td>
			<td id="neganota"> <?php echo $cont."º"; ?></td>

	<?php	} elseif ($cont == 2) {?>

			<td id="posinota2"> <?php echo $value["nomeAluno"]?> </td>
			<td id="neganota"> <?php echo number_format($value["mediaAluno"], 1)?> </td>
			<td id="neganota"> <?php echo $cont."º"; ?></td>

<?php	} elseif ($cont == 3) {?>
	<td id="posinota3"> <?php echo $value["nomeAluno"]?> </td>
			<td id="neganota"> <?php echo number_format($value["mediaAluno"], 1)?> </td>
			<td id="neganota"> <?php echo $cont."º"; ?></td>

<?php	} elseif ($cont == 4) {?>
			<td id="posinota4"> <?php echo $value["nomeAluno"]?> </td>
			<td id="neganota"> <?php echo number_format($value["mediaAluno"], 1)?> </td>
			<td id="neganota"> <?php echo $cont."º"; ?></td>

<?php	} else {?>
			<td id="posinota4"> <?php echo $value["nomeAluno"]?> </td>
			<td id="neganota"> <?php echo number_format($value["mediaAluno"], 1)?> </td>
			<td id="neganota"> <?php echo $cont."º"; ?></td>

<?php	}

		?> 
		
	
		</tr>

	<?php	

		//<h3>Em breve serão lançadas as pautas dos alunos neste site</h3>


		}?>




</body>
</html>
