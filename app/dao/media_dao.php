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
}