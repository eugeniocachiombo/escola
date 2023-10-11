<?php

function GetConnection() {
	
	try {

        /*
            $host = 'mysql:host=localhost;dbname=id19984116_escola;charset=utf8';
            $user = 'id19984116_escolagp';
            $password = '2#7{^0l~5O4Y5(G^';
        */
        
        $host = 'mysql:host=localhost;dbname=escola;charset=utf8';
        $user = 'root';
        $password = '';

        $pdo = new PDO( $host, $user, $password );
        return $pdo;

    } catch ( Exception $e ) {

        echo 'Erro de conexao: '.$e->getMessage();
    }

}
?>