<?php

class MarcarProvaDao {
    
    function GetWithAluno($id_aluno){
        $con = GetConnection();
        $sql = "select * from marcar_prova where id_aluno = ?";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(1, $id_aluno);
        $stmt->execute();
        return $stmt->fetchAll(); 
    }
}
