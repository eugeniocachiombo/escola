<?php

class MarcarProvaDao {
    
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
