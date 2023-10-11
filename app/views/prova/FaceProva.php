<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Opções de Provas</title>
	<meta charset="utf-8">
	<style type="text/css">
		
		body{
			color: white;
			background: gray;
		}

		#Cabeçario{
			background: #068ccb;
			color: white;
			text-align: left;
		}

		#corpo{
			/*background: #c9d5db;*/
			color: black;
			text-align: center;
		}

		footer{
			background: #068ccb;
			color: white;
		}

		#image{
			width: 10%
		}
		#campo{
			background: green;
			color: white;
		}
		
		#pad{
			padding: 1px;
			display: block;
		}

	</style>
</head>
<body>
	<div id="Cabeçario">



		
		
		<br>
	<label>	<a href="FaceProva.php"><img src="../Imagens/2logo.png" id="image"></a>
<h3>Sessão: <strong style="color: white"><?php echo $_SESSION["nome"]; ?></strong><br></h3>
		
	</label>

	</div>
	

	<?php
	

	require_once 'Prova.php';

	if (isset($_POST["resultado"])) {

	$aluno = new Aluno();
	$professor = new Professor();
	$disciplina = new Disciplina($professor);

	$prova = new Prova($aluno, $disciplina);

	$nome = $_SESSION["nome"];
	$id = $_SESSION["id"];

	$prova->setAceite(true);
	$aluno->setNome($nome);
	$aluno->setId($id);
	$prova->Resultado();

	echo "<br><a href= 'FaceProva.php' style= 'color: white' > Limpar Registro </a><br> <br>";
	}
?>



	<div id="corpo">
		<br>


			<form>
			<fieldset id="campo">
	<strong>Opções de Prova</strong> <br>
			<br><br>
		<a href="MarcarProva.php">	<input type="Button" name="" value="Marcar Prova"> </a>
		<a href="FazerProva.php">	<input type="Button" name="" value="Fazer Prova"></a> <br> <br>
		</form>


			<br><br>
		<form method="POST"> 
			<input type="submit" name="resultado" value="Resultado">
		</form>


			<br>
		<form method="POST"> 
			<input type="submit" name="terminar" value="Terminar Sessão">
		</form>

			
			
			</fieldset>

			
		 <br> 
	</div>
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
<?php
	
	if (isset($_POST["terminar"])) {
		
		session_destroy();

		header("location:../Inicio/Login.php");
	}


?>