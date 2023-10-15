<?php

class ProfessorDao {
    function Create( $pessoa ) {
        $con = GetConnection();
        $sql = 'insert into professor (nome_prof, email_prof, senha_prof, idade_prof, morada_prof, genero_prof) values(?, ?, md5(?), ?, ?, ?)';
        $stmt = $con->prepare( $sql );
        $stmt->bindValue( 1, $pessoa->GetNome() );
        $stmt->bindValue( 2, $pessoa->GetEmail() );
        $stmt->bindValue( 3, $pessoa->GetSenha() );
        $stmt->bindValue( 4, $pessoa->GetIdade() );
        $stmt->bindValue( 5, $pessoa->GetMorada() );
        $stmt->bindValue( 6, $pessoa->GetGenero() );
        return $stmt->execute();
    }

    function GetAutenticate( $email, $senha ) {
        $con = GetConnection();
        $sql = 'select * from professor where email_prof = ? and senha_prof = md5(?)';
        $stmt = $con->prepare( $sql );
        $stmt->bindValue( 1, $email );
        $stmt->bindValue( 2, $senha );
        $stmt->execute();
        return $stmt->fetch();
    }

    function VerifyEmail( $email ) {
        $con = GetConnection();
        $sql = 'select * from professor where email_prof = ?';
        $stmt = $con->prepare( $sql );
        $stmt->bindValue( 1, $email );
        $stmt->execute();
        return $stmt->fetch();
    }

    function GetWithId( $id_prof ) {
        $con = GetConnection();
        $sql = 'select * from professor where id_prof = ?';
        $stmt = $con->prepare( $sql );
        $stmt->bindValue( 1, $id_prof );
        $stmt->execute();
        return $stmt->fetch();
    }

    function GetIdProfNomeProf() {
        $con = GetConnection();
		$sql = "select id_prof, nome_prof from professor";
		$stmt = $con->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
    }
}
