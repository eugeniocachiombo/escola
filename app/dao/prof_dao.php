<?php

class ProfessorDao {
    public function lançarNota( $professor ) {
        echo 'O professor '.$professor->getNome().' Lançará as notas em Breve';
    }

    function GetWithId( $id_prof ) {
        $con = GetConnection();
        $sql = 'select * from professor where id_prof = ?';
        $stmt = $con->prepare( $sql );
        $stmt->bindValue( 1, $id_prof );
        $stmt->execute();
        return $stmt->fetch();
    }
}
