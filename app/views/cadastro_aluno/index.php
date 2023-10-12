<?php 

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
			} else {


			echo "<p align= 'center' style= 'background: red' > Erro ao inserir </p>";
			}
						
			};

	}
?>
<?php include 'menu/bars.php';?>
<?php include '../_inc/headHTML.php';?>
<?php include '../_inc/header.php';?>
<title>Cadastrar Aluno</title>

<main class=" d-flex align-items-center">
	<div class="container">
		<center>
			<form method="POST">
				<div>
                    <h1 class="text-start" style="text-decoration: underline">Cadastrar Aluno</h1> <hr>
				</div>
						
				<div class="d-table d-md-flex ">
					<div class="col  m-2">
						<label class="w-100 text-start" for="nome"> Nome:</label> 
						<input class="form-control" type="text" id="" name="nome"> 

						<label class="w-100 text-start" for=""> Email:</label> 
						<input class="form-control" type="text" id="" name="email">
					</div>

					<div class="col m-2">
						<label class="w-100 text-start" for=""> Senha:</label> 
						<input class="form-control" type="password" id="" name="password" maxlength="6"> 

						<label class="w-100 text-start" for="">Idade:</label> 
						<input class="form-control" type="text" id="" name="idade" maxlength="2">
					</div>

					<div class="col m-2">
						<label class="w-100 text-start" for="">Morada:</label> 
						<input class="form-control" type="text" id="" name="morada"> 

						<label class="w-100 text-start" for="">Gênero:</label> 
						<select class="form-control" id="" name="genero">
							<option>Selecione....</option>
							<option value="M">Masculino</option>
							<option value="F">Femenino</option>
						</select>
					</div>

					<div class="col m-2 d-flex align-items-center ">
						<input class="form-control " style="width: 205px;" type="submit" id="" name="cadastrar" value="Cadastrar">
					</div>
				</div>

				
			</form>
		</center>
	</div>
</main>

<?php include '../_inc/footer.php';?>
<?php include '../_inc/footHTML.php';?>