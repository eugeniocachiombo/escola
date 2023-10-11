
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Cadastro</title>
	<meta charset="utf-8">
	<style type="text/css">
		
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

		table{
			background: #068ccb;
			color: white;
			width: 80%;
		}

		#cab{
			background: gray;
		}

	</style>
</head>
<body>
	<div id="Cabeçario">
	
		<br>
	<label> <a href="../index.php"><img src="../Imagens/2logo.png" id="image"></a>	
		<h3>  
			Total de disciplinas e respectivos professores da Escola Cachiombo
		</h3>
	</label>

	</div>


<!--FORMULÁRIO------------------------------------------>	
	<div id="corpo">
		
		<?php
		include '../Conexao.php';

		$con = getConexao();

		$sql = "select * from disciplina a
				inner join professor b
				On a.codprof = b.id";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();?>


		<table border="1" align="center">
				<tr id="cab">

				<th> Disciplina </th>
				<th> Professor </th>
		
				</tr>

	<?php	foreach ($result as $value) { ?>
 
				
		<tr>
		<td> <?php echo $value["nomeDisc"]?> </td>
		<td> <?php echo $value["nome"]?> </td>
		</tr>

	<?php	}?>
	
		
			</table>
	

	</div>
<!--FORMULÁRIO------------------------------------------>	


</body>

<footer>
	<dl>
		
		<dt> <h3> Sobre </h3></dt>

		<dd>
			Este site foi criador pelo estudante Eugénio Cachiombo do curso de Engenharia Informática. <br>
			<strong>Localização:</strong> Município do Cazenga, bairro Mabor / Hoji-yá-Henda<br>
			<strong>Contactos:</strong> 921439849 <strong>whatsapp:</strong> 921439849 <strong>Facebook:</strong> Génio Pró Gp
			
			
		</dd>

	</dl>

		 <br>
</footer>
</html>
