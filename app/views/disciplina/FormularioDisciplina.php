	<?php
	include '../Conexao.php';

	if (isset($_POST["cadastrar"])) {
		
		$nomeDisc = $_POST["nomeDisc"];
		$codprof = $_POST["codprof"];


		$con = getConexao();

		$sql2 = "insert into disciplina (nomeDisc, codprof) values(?, ?)";

		$stmt = $con->prepare($sql2);
		$stmt->bindValue(1, "$nomeDisc");
		$stmt->bindValue(2, "$codprof");
		
		if ($stmt->execute()) {
		echo "<p align= 'center' style= 'background: green; color: white' > Inserido com sucesso </p>";
		} else{
		echo "<p align= 'center' style= 'background: red; color: white' > Erro!!! ao inserir </p>";
		}

	}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Cadastro</title>
	<meta charset="utf-8">
	<style type="text/css">
		
		body{
			color: black;
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
	<strong>Inserir Disciplina</strong> <br>
			
	<br><label id="pad"> Nome da disciplina:</label> 
	<label id="pad"><input type="text" name="nomeDisc"></label> 

	<label id="pad">Nome do Professor:</label>


	<?php 

		

		$con = getConexao();

		$sql = "select id, nome from professor";

		$stmt = $con->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		

		?>
	<label id="pad"><select name="codprof">

		<option>Selecione...</option>

		<?php foreach ($result as $value) {?>

			<option value="<?php  echo $value['id']; ?>">
					
					<?php  //echo $value['id']; ?>
					<?php  echo $value['nome']; ?>
			
				<?php }?>
				</option>
				
				</select>
				</label>
	<br> 			
	<label id="pad"><input type="submit" name="cadastrar" value="Cadastrar"></label>
				<p>Pretende iniciar sessão de um aluno?</p>
				<a href="Login.php"><p>Clique Aqui</p></a>
	<br> 			
	<label id="pad"><a href="VerDisciplinas.php"><input type="button" value="Ver Disciplinas">
	</a></label>
				</fieldset>

			</form>
		 <br> 
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

