<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Login</title>
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
	
	<div id="corpo">


		<?php

	
	if (isset($_POST["sessao"])) {

		session_start();
		
			$recnome = $_POST["nome"];
			$recsenha = $_POST["senha"];  

			if ($recnome ==  "" || $recsenha == "") {
			echo "<p align= 'center' style= 'background: red; color: white' > Existem campo vazio </p>"; 


			 } else {

			 	include '../Conexao.php';

			 	$con = getConexao();

			 	//$sql = "select * from aluno, professor where nome =? and senha =? ";

			 	$sql= "select * from aluno 
			 	where nome = ? and senha = ?";



			 	$stmt = $con->prepare($sql);
			 	$stmt->bindValue(1, $recnome);
			 	$stmt->bindValue(2, $recsenha);
			 	$stmt->execute();	 	

		if ($result= $stmt->fetch()) {
		//echo "<p align= 'center' style= 'background: green; color: white'> Encontrado </p>"; 	
		//header("location:../Prova/FaceProva.php"); 

		?>
		<script type="text/javascript">
			
			window.location ="../Prova/FaceProva.php";
		</script>
		<?php

				$_SESSION["id"] = $result["id"];
				$_SESSION["nome"] = ucwords($result["nome"]);
				$_SESSION["senha"] = $result["senha"];
				$_SESSION["idade"] = $result["idade"];
				$_SESSION["morada"] = $result["morada"];
				$_SESSION["genero"] = $result["genero"];		
			 	} 
		else{
		echo "<p align= 'center' style= 'background: red; color: white'> Usuário Não Encontrado</p>";

		
			 	}


			 }


	}

?>

			<form method="POST">
			<fieldset id="campo">
	<strong>Login</strong> <br>
		

	<br><label id="pad"> Nome:</label>  
	<label id="pad"><input type="text" name="nome"></label> 
				
	<label id="pad"> Senha:</label> 
	<label id="pad"><input type="password" name="senha"></label>

	<br> 
	<label id="pad"><input type="submit" name="sessao" value="Iniciar Sessão"></label> <br> 
	<label id="pad">
<a href="Página Inicial.php"><input type="button" name="" value="Cancelar"> </a>
</label> 
	

			<br>
<label><p align= 'center' style= 'background: blue; color: white'>
		<?php echo "Somente para alunos" ?></p></label>
				</fieldset>

			</form>
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
