<?php

if ( isset( $_POST[ 'cadastrar' ] ) ) {

    $nome = 	$_POST[ 'nome' ];
    $email = 	$_POST[ 'email' ];
    $password = $_POST[ 'password' ];
    $idade = 	$_POST[ 'idade' ];
    $morada = 	$_POST[ 'morada' ];
    $genero = 	$_POST[ 'genero' ];

    if ( $nome == '' || $email == '' || $password == '' || $idade == '' || $morada == '' || $genero == '' ) {

        echo "<p align= 'center' style= 'background: red' > Existe campo vazio </p>";

    } else {
        $con = GetConnection();
        $sql = 'insert into aluno(nome_aluno, email_aluno, senha_aluno, idade_aluno, morada_aluno, genero_aluno) values(?, ?, md5(?), ?, ?, ?)';
        $stmt = $con->prepare( $sql );
        $stmt->bindValue( 1, $nome );
        $stmt->bindValue( 2, $email );
        $stmt->bindValue( 3, $password );
        $stmt->bindValue( 4, $idade );
        $stmt->bindValue( 5, $morada );
        $stmt->bindValue( 6, $genero );

        if ( $stmt->execute() ) {
            echo "<p align= 'center' style= 'background: green' > Cadastrado com sucesso </p>";
        } else {
            echo "<p align= 'center' style= 'background: red' > Erro ao inserir </p>";
        }

    }

}
?>