<?php

class DisciplinaDao {
    
    function GetWithId($id_disc) {
        $con = GetConnection();
        $sql = 'select * from disciplina where id_disc = ?';
        $stmt = $con->prepare( $sql );
        $stmt->bindValue( 1, $id_disc );
        $stmt->execute();
        return $stmt->fetch();
    }

}
