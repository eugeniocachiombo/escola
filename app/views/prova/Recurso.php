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
<h3>Sessão: <strong style="color: black"><?php echo $_SESSION["nome"]; ?></strong><br></h3>
		
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

	<?php
	
			//	$Aluno = $_POST["nomeAluno"];
				$disciplina = $_POST["disciplina"];
				$nota = $_POST["nota"];
				$idPauta = $_POST["idPauta"];
				?>

			<form method="POST">
	<p align= 'center' style= 'color: white;' > <h4> Faça já a Recuperação de suas notas</h4></p>
			<input type="hidden" readonly name="aluno1" value="<?php echo $_SESSION["nome"] ?>">
			<input type="hidden" readonly name="idPauta" value="<?php echo $idPauta ?>">
			<input type="hidden" readonly name="disciplina" value="<?php echo $disciplina ?>">
			<input type="hidden" readonly name="nota" value="<?php echo $nota ?>">
			<input type="submit" name="bt" value="Fazer Recurso">
			</form>
	<?php

		if (isset($_POST["bt"])) {

			$converter = intval($_POST["nota"]); 
			
			if ($converter <= 13 && $converter >= 8) {
			
			echo "<p align= 'center' style= 'background: green; color: white' > Melhoria feito com sucesso, disciplina '****".$disciplina."****'</p>"; 


			//	include '../Conexao.php';

				$con = getConexao();

				$sql = "update pauta 
						set nomeAluno = ?,
						disciplina = ?,
						nota = ?,
						cont = '1' where idPauta = ?";

				$novaNota = $nota + rand(0, 7);
				$Nomenovo = $_POST["aluno1"];


				$stmt = $con->prepare($sql);
				$stmt->bindValue(1, $Nomenovo);
				$stmt->bindValue(2, $disciplina);
				$stmt->bindValue(3, $novaNota);
				$stmt->bindValue(4, $idPauta);
				$stmt->execute();

			} elseif ($converter <= 7) {
			
			echo "<p align= 'center' style= 'background: green; color: white' > Recurso feito com sucesso, disciplina '****".$disciplina."****'</p>"; 


			//	include '../Conexao.php';

				$con = getConexao();

				$sql = "update pauta 
						set nomeAluno = ?,
						disciplina = ?,
						nota = ?,
						cont = '1' where idPauta = ?";

				$novaNota = $nota + rand(0, 13);
				$Nomenovo = $_POST["aluno1"];


				$stmt = $con->prepare($sql);
				$stmt->bindValue(1, $Nomenovo);
				$stmt->bindValue(2, $disciplina);
				$stmt->bindValue(3, $novaNota);
				$stmt->bindValue(4, $idPauta);
				$stmt->execute();

			} 


			else {
			

		echo "<p align= 'center' style= 'background: red; color: white' > Impossível fazer Recurso, a disciplina '****".$disciplina."****' já foi dispensada</p>"; 
			}




		}

	?>



	<div id="corpo">
		<br>


			<form>
			<fieldset id="campo">
	<strong>Opções de Prova</strong> <br>
			
		</form>


			<br><br>
		
		<a href="FaceProva.php"><input type="button" name="resultado" value="Inicio"></a><br>
	


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