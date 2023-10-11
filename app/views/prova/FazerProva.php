<?php session_start();  ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Fazer prova</title>
	<meta charset="utf-8">
	<style type="text/css">

		table{
			color: white;
			background: gray;
			align-items: center;
		}
		
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
	/*include '../Conexao.php';

	$con = getConexao();*/
	

	$aluno = new Aluno();

	$aluno->setId($_SESSION["id"]);
	$aluno->setNome($_SESSION["nome"]);
	$aluno->setIdade($_SESSION["idade"]);
	$aluno->setGenero($_SESSION["genero"]);
	$aluno->setMorada($_SESSION["morada"]);
	$aluno->matriculado();

	$nome = $_SESSION["nome"];

	$professor = new Professor();
	$disciplina = new Disciplina($professor);

	$prova = new Prova($aluno, $disciplina);

	if ($nome) {
		
		
	

	

	$sql = "select * from marcarProva where nomeAluno = ?";

	$stmt = $con->prepare($sql);
	$stmt->bindValue(1, $nome);
	$stmt->execute();
	$result = $stmt->fetchAll(); ?>

	<?php $a = 0; ?>
<h1 align="center">Provas Marcadas</h1>
	<table border="1" align="center">
		<tr align="center" bgcolor="#04b131">
			<th>Nome do Aluno</th>
			<th>Nome da Disciplina</th>
			<th>Docente</th>
			<th>Opções</th>
		</tr>
		
		<tr align="center">

			<?php
			foreach ($result as $value) {?>
			
			<td align="center"><?php echo $value["nomeAluno"] ?></td>
			<td align="center"><?php echo $value["nomeDisciplina"] ?></td>
			<td align="center"><?php echo $value["nomeProfessor"] ?>  </td>
		 
			<td align="center"> 

				<form method="POST" action="FazerProva.php">
<input type="hidden" name="disc" value="<?php echo $value["nomeDisciplina"] ?>">
<input type="hidden" name="aluno" value="<?php echo $value["nomeAluno"] ?>">
<input type="hidden" name="prof" value="<?php echo $value["nomeProfessor"] ?>">
<input type="hidden" name="id" value="<?php echo $value["idMarcarProva"] ?>">
		<input type="submit" name="comecar" value="Começar"> </a>	
		<input type="button"  value="Cancelar">			
				</form>
				
<?php	$a = $a + 1; ?>
			</td>
		
			
		</tr>
		<?php	} ?>
	</table>

	<?php
	if ($a == 0) {
	echo "<p style='color:white; background: blue' align='center'> Ainda não temos informações de provas marcadas pelo aluno/a ".$nome."</p>";	

			} elseif(isset($_POST["comecar"])){

			
			$prova->setAceite(true);
			$disciplina->setNomeDisciplina($_POST["disc"]);
			$aluno->setNome($_POST["aluno"]);
			$professor->setNome($_POST["prof"]);
			$prova->setData(date("d-m-y"));
			$nota = rand(0,20);
			$prova->setNota($nota);
			
			

				$select = "select * from pauta 
			where disciplina = ? and nomeAluno = ?";

			$stmt3 = $con->prepare($select);
			$stmt3->bindValue(1, $disciplina->getNomeDisciplina());
			$stmt3->bindValue(2, $aluno->getNome());
			$stmt3->execute();
			$resulta3 = $stmt3->fetch();
		

	

	if (empty($resulta3["nomeDisciplina"]) && empty($resulta3["nomeAluno"])) {
				
		$sql = "insert into pauta (nomeAluno, disciplina, nota, cont) values (?, ?, ?, '1') ";
			$stmt= $con->prepare($sql);
			$stmt->bindValue(1, $aluno->getNome());
			$stmt->bindValue(2, $disciplina->getNomeDisciplina());
			$stmt->bindValue(3, $prova->getNota());
			$stmt->execute();

			$prova->fazerProva();

			$id = $_POST["id"];
			$delete = "delete from marcarProva 
			where idMarcarProva = ?";

			$stmt2 = $con->prepare($delete);
			$stmt2->bindValue(1, $id);
			$stmt2->execute();
		}
	
	 else{

	 	echo "<h2> <p align= 'center' style= 'background: red; color: white' >  A prova de ".$disciplina->getNomeDisciplina()." já foi feita   </p> </h2>";

	echo "<a href='FazerProva.php' style='color:white; text-align: center'> Limpar </a>";


	
	}

			
		}



	} 
	?>


	<div id="corpo">
		<br>

			<form method="POST">
			<fieldset id="campo">
	<strong>Opções de Prova</strong> <br>
			<br><br>
			
		
		<a href="FaceProva.php">	<input type="Button" name="" value="Voltar"> </a>
			</form>

		

			<br><br>
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