<?php

class MarcarProvaDao {
    
    function Create($id_aluno, $id_disc, $id_prof){
        $con = GetConnection();
		$sql = "insert into marcar_prova (id_aluno, id_disc, id_prof) values(?, ?, ?)";
		$stmt = $con->prepare($sql);
		$stmt->bindValue(1, $id_aluno);
		$stmt->bindValue(2, $id_disc);
		$stmt->bindValue(3, $id_prof);
		return $stmt->execute();
    }

    function GetWithAlunoDisc($id_disc, $id_aluno){
        $con = GetConnection();
		$sql = "select * from marcar_prova 
		where id_disc = ? and id_aluno = ?";
		$stmt = $con->prepare($sql);
		$stmt->bindValue(1, $id_disc);
		$stmt->bindValue(2, $id_aluno);
		$stmt->execute();
		return $stmt->fetch();
    }

    function Delete($id_marcar_prova){
        $con = GetConnection();
		$sql = "delete from marcar_prova 
		where id_marcar_prova = ?";
		$stmt = $con->prepare($sql);
		$stmt->bindValue(1, $id_marcar_prova);
		$stmt->execute();
    }

    function GetWithAluno($id_aluno){
        $con = GetConnection();
        $sql = "select * from marcar_prova where id_aluno = ?";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(1, $id_aluno);
        $stmt->execute();
        return $stmt->fetchAll(); 
    }
}
