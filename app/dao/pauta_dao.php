<?php

class PautaDao 
{
    function GetAll(){
        $con = GetConnection();
        $sql_disc = "select * from pauta 
		left outer join aluno
		on pauta.id_aluno = aluno.id_aluno
		left outer join disciplina
		on pauta.id_disc = disciplina.id_disc order by nome_aluno asc";
		$stmt_disc = $con->prepare($sql_disc);
		$stmt_disc->execute();
		return $stmt_disc->fetchAll();
    }

    function GetDistinctNameDisc(){
        $con = GetConnection();
		$sql_disc = "select distinct nome_disc from pauta 
		left outer join aluno
		on pauta.id_aluno = aluno.id_aluno
		left outer join disciplina
		on pauta.id_disc = disciplina.id_disc ";
		$stmt_disc = $con->prepare($sql_disc);
		$stmt_disc->execute();
		return $stmt_disc->fetchAll();
    }

    function GetNota($id_aluno){
        $con = GetConnection();
		$sql_disc = "select nota from pauta where id_aluno = ?";
		$stmt_disc = $con->prepare($sql_disc);
		$stmt_disc->bindValue(1, $id_aluno);
		$stmt_disc->execute();
		return $stmt_disc->fetchAll();
    }
}
