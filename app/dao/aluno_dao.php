<?php

class AlunoDao {
    
    function Create( $pessoa ) {
        $con = GetConnection();
        $sql = 'insert into aluno(nome_aluno, email_aluno, senha_aluno, idade_aluno, morada_aluno, genero_aluno) values(?, ?, md5(?), ?, ?, ?)';
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
        $sql = 'select * from aluno where email_aluno = ? and senha_aluno = md5(?)';
        $stmt = $con->prepare( $sql );
        $stmt->bindValue( 1, $email );
        $stmt->bindValue( 2, $senha );
        $stmt->execute();
        return $stmt->fetch();
    }

    function VerifyEmail( $email ) {
        $con = GetConnection();
        $sql = 'select * from aluno where email_aluno = ?';
        $stmt = $con->prepare( $sql );
        $stmt->bindValue( 1, $email );
        $stmt->execute();
        return $stmt->fetch();
    }

    function SeeGrade() {
        if ( $this->GetRegisted() == true ) {
            $this->Registed();
        } else {
            $this->NotRegisted();
        }
    }

    function ShowDates() {
        echo "<legend align = 'center' > Dado do Aluno </legend>";
        echo 'Nome: '.$this->GetNome().'<br>';
        echo 'Idade: '.$this->GetIdade().' anos<br>';
        echo 'Gênero: '.$this->GetGenero().'<br>';
        echo 'Morada: '.$this->GetMorada().'<br>';
    }
}
