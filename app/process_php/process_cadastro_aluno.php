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
        $pessoa = new Pessoa();
        $pessoa->SetId(0);
        $pessoa->SetNome($nome);
        $pessoa->SetEmail($email);
        $pessoa->SetIdade($idade);
        $pessoa->SetGenero($genero);
        $pessoa->SetMorada($morada);
        $aluno_dao = new AlunoDao();
        $result = $aluno_dao->Create($pessoa);

        if ( $result ) {
            echo "<p align= 'center' style= 'background: green' > Cadastrado com sucesso </p>";
        } else {
            echo "<p align= 'center' style= 'background: red' > Erro ao inserir </p>";
        }

    }

}
?>