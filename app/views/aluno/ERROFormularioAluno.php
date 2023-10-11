<?php 
		session_start();
		echo "<p align= 'center' style= 'background: red' > Existe campo vazio </p>";
			if (isset($_POST["cadastrar"])) {
		
		
			 $nome =	$_POST["nome"];
	     $password =	$_POST["password"];
			$idade =	$_POST["idade"];
		   $morada =	$_POST["morada"];
		   $genero =	$_POST["genero"];

		   $_SESSION["nome"]      =	 $nome;
		   $_SESSION["password"]  =	 $password;
		   $_SESSION["idade"]     =	 $idade;
		   $_SESSION["morada"]    =	 $morada;
		   $_SESSION["genero"]    =	 $genero;

		   

	if ($nome == "" || $password == "" || $idade == "" || $morada == "" || $genero == "") {	

				
				//echo "<p align= 'center' > Existe campo vazio </p>";

			header("location:ERROFormularioAluno.php");
			} else {
				


			include '../Conexao.php';

			$con = getConexao();

		 
			$sql = "insert into aluno(nome, senha, idade, morada, genero) values(?, ?, ?, ?, ?)";

			$stmt = $con->prepare($sql);
			$stmt->bindValue(1, "$nome");
			$stmt->bindValue(2, "$password");
			$stmt->bindValue(3, "$idade");
			$stmt->bindValue(4, "$morada");
			$stmt->bindValue(5, "$genero");

			if ($stmt->execute()) {
				
			echo "<p align= 'center' style= 'background: green' > Inserido com sucesso </p>";
			$_SESSION["nome"]      =	 "";
		   $_SESSION["password"]  =	 "";
		   $_SESSION["idade"]     =	 "";
		   $_SESSION["morada"]    =	 "";
		   $_SESSION["genero"]    =	 "";
		   header("location:../Login2.php");
			} else {


			echo "<p align= 'center' style= 'background: red' > Erro ao inserir </p>";
			}
			


			};

	}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Cadastro de alunos</title>
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
			color: black;
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

	</style>
</head>
<body>
	<div id="Cabeçario">
	
		<br>
	<label>	<a href="../index.php"><img src="../Imagens/2logo.png" id="image"></a>
		<h3> Seja Bem-vindo  <br>
			Pauta dos estudantes da escola Cachiombo
		</h3>
	</label>

	</div>


<!--FORMULÁRIO------------------------------------------>	
	<div id="corpo">
		<br>

			<form method="POST">
			<fieldset id="campo">
	<strong>Cadastro de Alunos</strong> <br>
			
	<br><label id="pad"> Nome:</label> 
	<label id="pad"><input type="text" name="nome" value="<?php echo $_SESSION["nome"] ?>"></label> 
				
	<label id="pad"> Senha:</label> 
	<label id="pad"><input type="password" maxlength="6" name="password" value="<?php echo $_SESSION["password"] ?>"></label>
				
	<label id="pad">Idade:</label> 
	<label id="pad"><input type="text" maxlength="2" name="idade" value="<?php echo $_SESSION["idade"] ?>"></label>
	
	 <label id="pad">Morada:</label>  
	 <label id="pad"><input type="text" name="morada" value="<?php echo $_SESSION["morada"] ?>"></label>

	<label id="pad">Gênero:</label>
	<label id="pad"><select name="genero">
					
					<?php
		$genero = $_SESSION["genero"];
	 if ($genero  == "Masculino") { ?>
			<option><?php echo $_SESSION["genero"] ?></option>
			<option>Femenino</option>

	<?php } elseif( $genero == "Femenino") { ?>
			<option><?php echo $_SESSION["genero"] ?></option>
			<option>Masculino</option>

	<?php	} else {?>
		<option></option>
		<option>Masculino</option>
		<option>Femenino</option>

	<?php   }  ?>





				</select>
				</label>
	<br> 			
	<label id="pad"><input type="submit" name="cadastrar" value="Cadastrar"></label>
				<p>Pretende iniciar sessão?</p>
				<a href="../Inicio/Login.php"><p>Clique Aqui</p></a>
				</fieldset>

			</form>
		 <br> 
	</div>
<!--FORMULÁRIO------------------------------------------>	

<?php
	//session_destroy();


?>


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

