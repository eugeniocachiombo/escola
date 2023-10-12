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
        $person = new Pessoa(0, $nome, $email, $idade, $genero, $morada);
        $aluno_dao = new AlunoDao();
        $result = $aluno_dao->Create($person);

        if ( $result ) {
            echo "<p align= 'center' style= 'background: green' > Cadastrado com sucesso </p>";
        } else {
            echo "<p align= 'center' style= 'background: red' > Erro ao inserir </p>";
        }

    }

}
?>