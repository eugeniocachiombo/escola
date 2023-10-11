<?php 
		session_start();

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

			header("location:ERROFormularioProfessor.php");
			} else {


			include '../Conexao.php';

			$con = getConexao();

		 
			$sql = "insert into professor(nome, senha, idade, morada, genero) values(?, ?, ?, ?, ?)";

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
			} else {


			echo "<p align= 'center' style= 'background: red' > Erro ao inserir </p>";
			}
			


				
			};

	}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Cadastro de professores</title>
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
	<strong>Cadastro de Professor</strong> <br>
			
	<br><label id="pad"> Nome:</label> 
	<label id="pad"><input type="text" name="nome" ></label> 
				
	<label id="pad"> Senha:</label> 
	<label id="pad"><input type="password" name="password" maxlength="6"></label>
				
	<label id="pad">Idade:</label> 
	<label id="pad"><input type="text" name="idade" maxlength="2"></label>
	
	 <label id="pad">Morada:</label>  
	 <label id="pad"><input type="text" name="morada" ></label>

	<label id="pad">Gênero:</label>
	<label id="pad"><select name="genero">
					
		
		<option></option>
		<option>Masculino</option>
		<option>Femenino</option>


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

