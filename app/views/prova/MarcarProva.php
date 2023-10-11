
<?php session_start(); ?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Marcação de provas</title>
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
	//include '../Conexao.php';

		//$con = getConexao();
	

	$aluno = new Aluno();

	$aluno->setId($_SESSION["id"]);
	$aluno->setNome($_SESSION["nome"]);
	$aluno->setIdade($_SESSION["idade"]);
	$aluno->setGenero($_SESSION["genero"]);
	$aluno->setMorada($_SESSION["morada"]);
	$aluno->matriculado();

	$professor = new Professor();
	$disciplina = new Disciplina($professor);

	$prova = new Prova($aluno, $disciplina);

	if (isset($_POST["marcarProva"])) {?>
			
		<form method="POST">
				
<input style="background:#068ccb; color: white; "  type="text" readonly name="nome" value="<?php echo $aluno->getNome()?>" placeholder="Aluno">

<?php 

		$sql = "select * from disciplina a
				inner join professor b
				On a.codprof = b.id";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();?>


<select style="background:#068ccb; color: white;" name="disc"> 

	<?php	foreach ($result as $value) {?>

	<option value="<?php echo $value["id_disc"]?>"><?php echo $value["nomeDisc"]; } ?>

	</option>
		
</select>



<input style="background:#068ccb; color: white; " readonly type="text" name="data" value="<?php echo date("y-m-d") ?>" placeholder="Data">
<input type="submit" name="Ok" value="Marcar">
<input type="submit" name="" value="Cancelar">


		</form>


	<?php	

}	elseif (isset($_POST["Ok"])) {

	

	$dc5 = $_POST["disc"];

	$a5 = "select * from disciplina
	inner join professor 
	on disciplina.codprof = professor.id
	where id_disc = ? ";

		$stmt5 = $con->prepare($a5);
		$stmt5->bindValue(1, $dc5);
		$stmt5->execute();
		$result5 = $stmt5->fetch();

	
	$professor->setNome($result5["nome"]);
	$professor->setGenero($result5["genero"]);

	$dc = $_POST["disc"];
	$a = "select * from disciplina
	inner join professor 
	on disciplina.codprof = professor.id
	where id_disc = ? ";

		$stmt2 = $con->prepare($a);
		$stmt2->bindValue(1, $dc);
		$stmt2->execute();
		$result2 = $stmt2->fetch();

	
	$disciplina->setNomeDisciplina($result2["nomeDisc"]);
	$prova->setAceite(true);
	$aluno->setNome($_SESSION["nome"]);
	$aluno->setMatricula(true);
	
	$prova->setData($_POST["data"]);
			
			

			$select = "select * from marcarProva 
			where nomeDisciplina = ? and nomeAluno = ?";

			$stmt3 = $con->prepare($select);
			$stmt3->bindValue(1, $disciplina->getNomeDisciplina());
			$stmt3->bindValue(2, $aluno->getNome());
			$stmt3->execute();
			$resulta3 = $stmt3->fetch();
		

			$di = $disciplina->getNomeDisciplina();
			$al = $aluno->getNome();

	

	if (empty($resulta3["nomeDisciplina"]) && empty($resulta3["nomeAluno"])) {
				

			$prova->marcarProva();



			$generar = $professor->getGenero();
			

			if ($generar != "Masculino") {
			
			
			$_SESSION["prof"] = "Professora: ";

			
			} else{

			$_SESSION["prof"] = "Professor: ";
			
			
			}


	echo "<p align= 'center'>  ".$_SESSION["prof"].$professor->getNome()."</p>";
	echo "<a href='MarcarProva.php' style='color:white; text-align: center'> Limpar </a>";



	$sql = "insert into marcarProva(nomeAluno, nomeDisciplina, nomeProfessor) values(?, ?, ?)";

	$stmt = $con->prepare($sql);
	$stmt->bindValue(1, $aluno->getNome());
	$stmt->bindValue(2, $disciplina->getNomeDisciplina());
	$stmt->bindValue(3, $professor->getNome());
	$stmt->execute();}
	
	 else{

	 	echo "<h2> <p align= 'center' style= 'background: red; color: white' >  Não é possível marcar já existe prova marcada com essa disciplina   </p> </h2>";

	echo "<a href='MarcarProva.php' style='color:white; text-align: center'> Limpar </a>";

	
	} }
?>



	<div id="corpo">
		<br>

			<form method="POST">
			<fieldset id="campo">
	<strong>Opções de Prova</strong> <br>
		
			
			<h1>!!!Marque aqui a sua prova!!!</h1>
		<input type="submit" name="marcarProva" value="Marcar Prova">
		<a href="FaceProva.php"><input type="Button" name="" value="Voltar"></a>
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