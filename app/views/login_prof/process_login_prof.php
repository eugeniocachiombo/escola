<?php
if ( isset( $_POST[ 'iniciar_sessao' ] ) ) {

    $email = $_POST[ 'email' ];
    $senha = $_POST[ 'senha' ];
    $prof_dao = new ProfessorDao();

    if ( $email ==  '' || $senha == '' ) {
        echo "<p align= 'center' style= 'background: red; color: white' > Existem campo vazio </p>";
    } else {
        
            $dates_prof = $prof_dao->GetAutenticate($email, $senha);
            if ( $dates_prof ) {

                $_SESSION[ 'id' ] = $dates_prof[ 'id_prof' ];
                $_SESSION[ 'nome' ] = $dates_prof[ 'nome_prof' ];
                $_SESSION[ 'email' ] = $dates_prof[ 'email_prof' ];
                $_SESSION[ 'senha' ] = $dates_prof[ 'senha_prof' ];
                $_SESSION[ 'idade' ] = $dates_prof[ 'idade_prof' ];
                $_SESSION[ 'morada' ] = $dates_prof[ 'morada_prof' ];
                $_SESSION[ 'genero' ] = $dates_prof[ 'genero_prof' ];
                echo "<p align= 'center' style= 'background: green; color: white'> Encontrado</p>";
                ?>
                    <script>
                    window.location = '../prova/index.php';
                    </script>
                <?php

            } else {
                echo "<p align= 'center' style= 'background: red; color: white'> Usuário Não Encontrado</p>";
            }

    }

}
?>