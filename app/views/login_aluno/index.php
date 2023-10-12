<?php include 'menu/bars.php';?>
<?php include '../_inc/headHTML.php';?>
<?php include '../_inc/header.php';?>
<title>Autenticação</title>


<main class=" d-flex align-items-center">
    <div class="container">
        <?php
            if (isset($_POST["iniciar_sessao"])) {
                
                    $recemail_aluno = $_POST["email_aluno"];
                    $recsenha_aluno = $_POST["senha_aluno"];  

                    if ($recemail_aluno ==  "" || $recsenha_aluno == "") {
                    echo "<p align= 'center' style= 'background: red; color: white' > Existem campo vazio </p>"; 


                    } else {

                        include '../Conexao.php';

                        $con = getConexao();

                        //$sql = "select * from aluno, professor where email_aluno =? and senha_aluno =? ";

                        $sql= "select * from aluno 
                        where email_aluno = ? and senha_aluno = ?";



                        $stmt = $con->prepare($sql);
                        $stmt->bindValue(1, $recemail_aluno);
                        $stmt->bindValue(2, $recsenha_aluno);
                        $stmt->execute();	 	

                if ($result= $stmt->fetch()) {
                    ?>
                        <script type="text/javascript">
                            window.location = "../Prova/FaceProva.php";
                        </script>
                    <?php

                        $_SESSION["id"] = $result["id"];
                        $_SESSION["email_aluno"] = ucwords($result["email_aluno"]);
                        $_SESSION["senha_aluno"] = $result["senha_aluno"];
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
    <center>
        <form method="POST">
                     

                    <div class="d-table w-50">
                        <div>
                            <h1 class="text-start" style="text-decoration: underline">Login</h1> <hr>
                        </div>

                        <div class="col">
                            <label class="text-start w-100" for="email_aluno">Email: </label> <br>
                            <input class="form-control" type="text" id="email_aluno" name="email_aluno"> 
                        </div>

                        <div class="col">
                            <label class="text-start w-100 pt-2" for="senha_aluno">Senha: </label> <br>
                            <input class="form-control" type="password" id="senha_aluno" name="senha_aluno">
                        </div class="col"> 

                        <div class="mb-3 mt-3">
                            <input class="form-control" type="submit" name="iniciar_sessao" value="Iniciar Sessão"> 
                            <input class="form-control mt-3" type="button" name="" value="Cancelar">
                        </div>

                        <p style='background: blue; color: white; width: 200px;'>
                            <?php echo "Somente para alunos" ?>
                        </p>

                    </div>
                    
                        
            </form>
        </div>
    </center>
</main>

<?php include '../_inc/footer.php';?>
<?php include '../_inc/footHTML.php';?>