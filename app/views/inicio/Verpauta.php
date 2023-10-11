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

		#p{
			text-align: right;
		}

		th{
			background: #04b131;
		}

		#a{
			background: gray;
		}

		#positiva{
			background: #0054fe;
		}

		#negativa{
			background: #fe0000;
		}

		#posinota{
			background: #04b131;
			color: white;
		}

		#neganota{
			background: #717171;
			color: #f85151;
		}
		#c{
			background: gray;
		}

		#a1{
			background: #04b131;
			color: white;
		}

		#a2{
			background: #06912a;
			color: white;
		}

		#a3{
			background: #047922;
			color: white;
		}


		#a4{
			background: #004c14;
			color: white;
		}
	</style>
</head>
<body>

	
	
	<center>
	<a href="Vermelhor.php" style="background: green; color: white;">Ver Melhor Classificação</a>
	</center> <br>

	<center>
	<a href="Reprovados.php" style="background: green; color: white;">Reprovados </a>
	</center> <br>

	<center>
	<a  href="Página Inicial.php" style="background: green; color: white;">
	Página Inicial
	</a>
	</center><br>
	
		<?php
		include '../Conexao.php';

		$con = getConexao();

		$sql = "select * from pauta ORDER BY disciplina asc ";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$cont = 0;
		?>


		<table border="1" align="center">
				<tr id="cab">

				
				<th> Disciplina </th>
				<th> Nome do Aluno </th>
				<th> Nota </th>
		
				</tr>

	<?php	foreach ($result as $value) { ?>
 
				
		<tr>
		<?php $cont = $cont + 1;     


		if ($cont == 1) {?>
			<td id="a1"> <?php echo $value["disciplina"]?> </td>

	<?php	} else if ($cont == 2) {?>
			<td id="a2"> <?php echo $value["disciplina"]?> </td>

	<?php	} elseif ($cont == 3) {?>
			<td id="a3"> <?php echo $value["disciplina"]?> </td>

	<?php	} elseif ($cont == 4) {?>
			<td id="a4"> <?php echo $value["disciplina"]?> </td>

	<?php	$cont = $cont - 4; } 



	?>
		


		<?php 

		if ($value["nota"] >= 9.5) { ?>
			
		<td id="positiva"> <?php echo $value["nomeAluno"]?> </td>
		<td id="posinota"> <?php echo intval($value["nota"]) ?> </td>

	<?php	} else { ?>

		<td id="negativa"> <?php echo $value["nomeAluno"]?> </td>
		<td id="neganota"> <?php echo intval($value["nota"])?> </td>

	<?php	}?>
		
		
		</tr>

	<?php	

		//<h3>Em breve serão lançadas as pautas dos alunos neste site</h3>


		}?>




</body>
</html>
