<?php

class DisciplinaDao {
    
    function Create($nome_disc, $id_prof) {
        $con = GetConnection();
		$sql2 = "insert into disciplina (nome_disc, id_prof) values(?, ?)";
		$stmt = $con->prepare($sql2);
		$stmt->bindValue(1, $nome_disc);
        $stmt->bindValue(2, $id_prof);
        return $stmt->execute();
    }

    function GetWithId($id_disc) {
        $con = GetConnection();
        $sql = 'select * from disciplina where id_disc = ?';
        $stmt = $con->prepare( $sql );
        $stmt->bindValue( 1, $id_disc );
        $stmt->execute();
        return $stmt->fetch();
    }

    function GetTotal() {
        $con = GetConnection();
        $sql = 'select count(*) from disciplina';
        $stmt = $con->prepare( $sql );
        $stmt->execute();
        return $stmt->fetch();
    }

    function GetAllWithId($id_disc) {
        $con = GetConnection();
        $sql = "select * from disciplina 
		inner join professor 
		On disciplina.id_prof = professor.id_prof
		where id_disc = ? ";
		$con = GetConnection();
		$stmt = $con->prepare($sql);
		$stmt->bindValue(1, $id_disc);
		$stmt->execute();
		return $stmt->fetch();
    }

    function GetAll() {
        $con = GetConnection();
		$sql = "select * from disciplina 
				inner join professor 
				On disciplina.id_prof = professor.id_prof";
		$stmt = $con->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
    }

}
