<?php

class MediaDao {
    function GetMediaId($id_aluno){
        $con = GetConnection();
		$sql = "select * from media where id_aluno = ?";
		$stmt = $con->prepare($sql);
		$stmt->bindValue(1, $id_aluno);
		$stmt->execute();
		return $stmt->fetch();
	}
	
    function GetClassification(){
        $con = GetConnection();
		$sql = "select * from media 
		left outer join aluno
		on media.id_aluno = aluno.id_aluno
		order by media_aluno desc";
		$stmt = $con->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
    }
}