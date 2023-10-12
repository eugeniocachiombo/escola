<?php
if ( isset( $_POST[ 'iniciar_sessao' ] ) ) {

    $email = $_POST[ 'email' ];
    $senha = $_POST[ 'senha' ];

    if ( $email ==  '' || $senha == '' ) {
        echo "<p align= 'center' style= 'background: red; color: white' > Existem campo vazio </p>";
    } else {

        $con = GetConnection();
        $sql = "select * from aluno where email_aluno = ? and senha_aluno = md5(?)";
        $stmt = $con->prepare( $sql );
        $stmt->bindValue( 1, $email );
        $stmt->bindValue( 2, $senha );
        $stmt->execute();
        $dates_aluno = $stmt->fetch();

        if ( $dates_aluno ) {

            $_SESSION[ 'id' ] = $dates_aluno[ 'id_aluno' ];
            $_SESSION[ 'email' ] = $dates_aluno[ 'email_aluno' ];
            $_SESSION[ 'senha' ] = $dates_aluno[ 'senha_aluno' ];
            $_SESSION[ 'idade' ] = $dates_aluno[ 'idade_aluno' ];
            $_SESSION[ 'morada' ] = $dates_aluno[ 'morada_aluno' ];
            $_SESSION[ 'genero' ] = $dates_aluno[ 'genero_aluno' ];
            echo "<p align= 'center' style= 'background: green; color: white'> Encontrado</p>";
            ?>
                <script>
                   // window.location = '../Prova/FaceProva.php';
                </script>
            <?php

        } else {
            echo "<p align= 'center' style= 'background: red; color: white'> Usuário Não Encontrado</p>";
        }

    }

}
?>