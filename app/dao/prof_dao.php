<?php

class ProfessorDao
{
    public function lançarNota($professor){
        echo "O professor ".$professor->getNome()." Lançará as notas em Breve";
    }
}
