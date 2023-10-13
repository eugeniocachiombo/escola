<?php

class ProvaDao
{
    function AgendTest($prova) {

        if ( $prova->GetAluno()->GetRegisted() == true ) {
          
            $genero = $prova->GetAluno()->GetGenero();
            
            if ( $genero != 'M' ) {
                $_SESSION[ 'aluno' ] = 'a aluna';
            } else {
                $_SESSION[ 'aluno' ] = 'o aluno';
            }

            $prova->SetAceite( true );
            $prova->SetData( date( 'd-m-Y' ) );

            echo "<p align= 'center'> Prova marcada, para data de: ".$prova->GetData().' com '.$_SESSION[ 'aluno' ] .' '.$prova->GetAluno()->GetNome().' disciplina: '.$prova->GetDisciplina()->GetNomeDisciplina().'</p>';

        } else {

            echo '<fieldSet>';
            echo 'Impossível marcar a prova, não afetuou a matricula do aluno/a';
            echo '</fieldSet>';
        }

    }

    function Result($prova) {

        if ( $prova->GetAceite() == true ) {

            $prova->GetAluno()->SetRegisted( true );

            $con = GetConnection();

            $sql = 'select * from pauta where nomeAluno = ?';
            $stmt = $con->prepare( $sql );
            $stmt->bindValue( 1, $prova->GetAluno()->GetNome() );
            $stmt->execute();
            $result = $stmt->fetchAll();
            $cont = 0;
            ?>

            <table border = '2' align = 'center'>

            <tr align = 'center' bgcolor = '#04b131'>
            <th>Disciplinas</th>
            <th>Notas</th>
            <th>Transição</th>
            <th>Recurso</th>
            </tr>

            <?php	foreach ( $result as $value ) { ?>
                <tr align = 'center' bgcolor = '#004c14'>
                <td><?php echo $value[ 'disciplina' ] ?> </td>

                <td><?php echo intval( $value[ 'nota' ] ) ?> </td>

                <td><?php $prova->SetNota( $value[ 'nota' ] );
                $prova->aprovar();
                ?> </td>

                <form method = 'POST' action = 'Recurso.php'>
                <input type = 'hidden' name = 'nomeAluno' value = "<?php echo $_SESSION['nome'] ?>">
                <input type = 'hidden' name = 'disciplina' value = "<?php echo $value['disciplina'] ?>">
                <input type = 'hidden' name = 'idPauta' value = "<?php echo $value['idPauta'] ?>">
                <input type = 'hidden' name = 'nota' value = "<?php echo $value['nota'] ?>">
                <td> <input type = 'submit' name = 'recurso' value = 'Fazer Recurso'> </td>
                </form>
                <?php
                $cont = $cont + 1;

            }

            ?>

            </tr>

            </table>

            <?php
            if ( $cont == 0 ) {

                echo "<p style='color:white; background: blue' align='center'> Ainda não há notas lançadas do aluno/a ".$prova->GetAluno()->GetNome().'</p>';
            } else {
                $prova->media();
            }

        } else {

            echo '<fieldSet>';
            echo 'Impossível ver os resultados, não foi feito nenhuma prova';
            echo '</fieldSet>';

        }

    }

    function MakeTest($prova) {
        if ( $prova->GetAceite() == true ) {
            
            echo '<legend><h4> Prova autorizada </h4> </legend>';
            echo '<h5> Prova a decorrer . . . </h5> </br>';

            $genero = $prova->GetAluno()->GetGenero();
            if ( $genero != 'M' ) {
                echo '<label>Aluna '.$prova->GetAluno()->GetNome().' está em prova </label><br>';
            } else {
                echo '<label>Aluno '.$prova->GetAluno()->GetNome().' está em prova </label><br>';
            }
            echo '<label>Fazendo prova de ***'.$prova->GetDisciplina()->GetNomeDisciplina().'***</label><br>';
            
            $genero = $prova->GetDisciplina()->GetProfessor()->GetGenero();
            if ( $genero != 'M' ) {
                echo '<label> Disciplina da professora: ';
            } else {
                echo '<label> Disciplina do professor: ';
            }
            echo $prova->GetDisciplina()->GetProfessor()->GetNome().'</label>';
            echo '<br> Data: '.$prova->GetData();

        } else {
            echo '<fieldSet>';
            echo 'Não foi marcada nenhuma prova';
            echo '</fieldSet>';
        }
    }

    function media() {

        if ( $prova->GetAceite() == true ) {

            $prova->GetAluno()->SetRegisted( true );

            $con = GetConnection();

            $sql = 'select sum(nota), sum(cont)  from pauta where nomeAluno = ?';

            $stmt = $con->prepare( $sql );
            $stmt->bindValue( 1, $prova->GetAluno()->GetNome() );
            $stmt->execute();
            $result = $stmt->fetchAll();

            ?>

            <table border = '2' align = 'center'>

            <tr bgcolor = '#004c14'>
            <th>Média Final</th>

            <?php	foreach ( $result as $value ) {
                ?>

                <?php

                $nota = ( $value[ 'sum(nota)' ] )/( $value[ 'sum(cont)' ] );

                $nota1 = number_format( $nota, 2 );
            }
            ?>
            <td bgcolor = '#004c14' align = 'center'><?php echo "<label style='color: #24fe00'> ".$nota1.'v </label>' ?></td>

            <td><?php

            $prova->SetNota( $nota1 );
            $prova->aprovarMedia();

            $notaFinal =  $prova->GetNota();

            $sql44 = 'insert into media (idMedia, nomeAluno, mediaAluno) values(?, ?, ?)';
            $con44 = GetConnection();
            $stmt44 = $con44->prepare( $sql44 );
            $stmt44->bindValue( 1, $prova->GetAluno()->GetId() );
            $stmt44->bindValue( 2, $prova->GetAluno()->GetNome() );
            $stmt44->bindValue( 3, intval( $notaFinal ) );

            $stmt44->execute();

            $sql45 = "Update media 
		Set nomeAluno = ?, 
		mediaAluno=? where idMedia = ?";
            $con45 = GetConnection();
            $stmt45 = $con45->prepare( $sql45 );
            $stmt45->bindValue( 1, $prova->GetAluno()->GetNome() );
            $stmt45->bindValue( 2, $prova->GetNota() );
            $stmt45->bindValue( 3, $prova->GetAluno()->GetId() );
            $stmt45->execute();

            ?></td>
            </tr>
            </table>

            <?php

        } else {

            echo '<fieldSet>';
            echo 'Impossível ver os resultados, não foi feito nenhuma prova';
            echo '</fieldSet>';

        }

    }

    function aprovar() {

        if ( $prova->GetAluno()->GetMatricula() == true ) {

            if ( $prova->GetAceite() == true && $prova->GetNota() >= 14 ) {

                echo '<fieldSet>';

                echo "<label style='color: #24fe00'> Dispensado </label>";

                echo '</fieldSet>';

            } elseif ( $prova->GetNota() >= 10 ) {
                echo '<fieldSet>';

                echo "<label style='color: #00d7fe'> Aprovado </label>";
                echo '</fieldSet>';

            } elseif ( $prova->GetNota() >= 7 ) {
                echo '<fieldSet>';

                echo "<label style='color: #ff8585'> Melhoria de notas </label>";
                echo '</fieldSet>';

            } else {
                echo '<fieldSet>';

                echo "<label style='color: #fd6652'> Reprovado </label>";
                echo '</fieldSet>';

            }

        } else {
            echo '<fieldSet>';

            echo 'Precisa de ter provas feitas';
            echo '</fieldSet>';

        }
    }

    function aprovarMedia() {

        if ( $prova->GetAluno()->GetMatricula() == true ) {

            if ( $prova->GetAceite() == true && $prova->GetNota() >= 9.5 ) {

                echo '<fieldSet>';

                echo "<label style='color: #24fe00'> Aprovado </label>";

                echo '</fieldSet>';

            } else {
                echo '<fieldSet>';

                echo "<label style='color: #fd6652'> Reprovado </label>";
                echo '</fieldSet>';

            }

        }
    }

    
}