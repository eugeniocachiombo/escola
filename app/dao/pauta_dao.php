<?php

class PautaDao {

    function Create($id_aluno,  $id_disc, $nota){
        $con = GetConnection();
        $sql = "insert into pauta (id_aluno, id_disc, nota) values (?, ?, ?) ";
		$stmt= $con->prepare($sql);
		$stmt->bindValue(1, $id_aluno);
		$stmt->bindValue(2, $id_disc);
		$stmt->bindValue(3, $nota);
		$stmt->execute();
	}

    function Update($id_aluno,  $id_disc, $nota, $id_pauta){
        $con = GetConnection();
		$sql = "update pauta 
				set id_aluno = ?,
				id_disc = ?,
				nota = ?
				where id_pauta = ?";
		$stmt = $con->prepare($sql);
		$stmt->bindValue(1, $id_aluno);
		$stmt->bindValue(2, $id_disc);
		$stmt->bindValue(3, $nota);
		$stmt->bindValue(4, $id_pauta);
		$stmt->execute();
	}
	
    function GetDiscAluno( $id_disc, $id_aluno){
		$con = GetConnection();
        $sql = "select * from pauta 
		where id_disc= ? and id_aluno = ?";
		$con = GetConnection();
		$stmt = $con->prepare($sql);
		$stmt->bindValue(1, $id_disc);
		$stmt->bindValue(2, $id_aluno);
		$stmt->execute();
		return $stmt->fetch();
	}
	
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
