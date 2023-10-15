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
        $pessoa->SetSenha($password);
        $pessoa->SetIdade($idade);
        $pessoa->SetGenero($genero);
        $pessoa->SetMorada($morada);
        $prof_dao = new ProfessorDao();
        
        if( $prof_dao->VerifyEmail( $pessoa->GetEmail() ) ){

            echo "<p align= 'center' style= 'background: red; color: white'> O email já está sendo utilizado</p>";
        
        } else {

            if ( $prof_dao->Create($pessoa) ) {
                echo "<p align= 'center' style= 'background: green' > Cadastrado com sucesso </p>";
            } else {
                echo "<p align= 'center' style= 'background: red' > Erro ao cadastrar </p>";
            }

        }
    }

}
?>