<?php include '../_inc/headHTML.php';?>
<?php include 'menu/bars.php';?>
<?php include '../_inc/header.php';?>
<?php include '../../config/db/connection.php';?>
<?php include '../../dao/aluno_dao.php';?>
<title>Autenticação</title>

<main class=" d-flex align-items-center">
    <div class="container">
        <center>
            <form method="POST">
                <div class="d-table w-50">
                    <div>
                        <h1 class="text-start" style="text-decoration: underline">Login</h1>
                        <hr>
                    </div>

                    <?php include '../../process_php/process_login_aluno.php';?>

                    <div class="col">
                        <label class="text-start w-100" for="email">Email: </label> <br>
                        <input class="form-control" type="text" id="email" name="email">
                    </div>

                    <div class="col">
                        <label class="text-start w-100 pt-2" for="senha">Senha: </label> <br>
                        <input class="form-control" type="password" id="senha" name="senha">
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