<?php include '../../config/db/connection.php';?>
<?php include 'menu/bars.php';?>
<?php include '../_inc/headHTML.php';?>
<?php include '../_inc/header.php';?>
<title>Cadastrar Aluno</title>

<main class=" d-flex align-items-center mb-4 mt-4">
	<div class="container">
		<center>
			<form method="POST">
				<div class="w-60">
					<h1 class="text-center text-md-start" style="text-decoration: underline">Cadastrar Aluno</h1> <hr>
				</div>

				<?php include '../../process_php/process_cadastro.php';?>
						
				<div class="d-table d-md-flex ">
					<div class="col  m-2">
						<label class="w-100 text-start" for="nome"> Nome:</label> 
						<input required class="form-control" type="text" id="nome" name="nome"> 

						<label class="w-100 text-start" for=""> Email:</label> 
						<input required class="form-control" type="email" id="email" name="email">
					</div>

					<div class="col m-2">
						<label class="w-100 text-start" for=""> Senha:</label> 
						<input required class="form-control" type="password" id="password" name="password" maxlength="6"> 

						<label class="w-100 text-start" for="">Idade:</label> 
						<input required class="form-control" type="text" id="idade" name="idade" maxlength="2">
					</div>

					<div class="col m-2">
						<label class="w-100 text-start" for="">Morada:</label> 
						<input required class="form-control" type="text" id="morada" name="morada"> 

						<label class="w-100 text-start" for="">Gênero:</label> 
						<select required class="form-control" id="genero" name="genero">
							<option>Selecione....</option>
							<option value="M">Masculino</option>
							<option value="F">Femenino</option>
						</select>
					</div>

					<div class="col m-2 mt-3 d-flex align-items-end ">
						<input class="form-control " style="width: 205px;" type="submit" id="" name="cadastrar" value="Cadastrar">
					</div>
				</div>
				
			</form>
		</center>
	</div>
</main>

<?php include '../_inc/footer.php';?>
<?php include '../_inc/footHTML.php';?>