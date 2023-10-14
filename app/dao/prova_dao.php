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

            $prova_dao = new ProvaDao();
            $prova->GetAluno()->SetRegisted( true );

            $con = GetConnection();
            $sql = 'select * from pauta where id_aluno = ?';
            $stmt = $con->prepare( $sql );
            $stmt->bindValue( 1, $prova->GetAluno()->GetId() );
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
                    
                    <?php
						$sql = "select * from disciplina where id_disc = ?";
						$stmt = $con->prepare($sql);
						$stmt->bindValue(1, $value["id_disc"]);
						$stmt->execute();
						$result = $stmt->fetch(); ?>
                    <td><?php echo $result[ 'nome_disc' ] ?> </td>

                    <td>
                        <?php 
                                if ( $value[ 'nota' ] >= 9.5 ) {

                                    echo "<label style='color: green'>" . intval( $value[ 'nota' ] ) . "</label>";

                                } else {

                                    echo "<label style='color: #fd6652'> " . intval( $value[ 'nota' ] ) . " </label>";

                                }
                        ?>
                    </td>

                    <td>
                        <?php 
                            $prova->SetNota( $value[ 'nota' ] );
                            $prova_dao->Passed($prova);
                        ?> 
                    </td>

                    <form method = 'POST' action = 'recurso.php'>
                        <input type = 'hidden' name = 'id_aluno' value = "<?php echo $_SESSION['id'] ?>">
                        <input type = 'hidden' name = 'id_disc' value = "<?php echo $value['id_disc'] ?>">
                        <input type = 'hidden' name = 'nome_disc' value = "<?php echo $result[ 'nome_disc' ] ?>">
                        <input type = 'hidden' name = 'id_pauta' value = "<?php echo $value['id_pauta'] ?>">
                        <input type = 'hidden' name = 'nota' value = "<?php echo $value['nota'] ?>">
                        <?php
                            if($value['nota'] > 6){
                                ?> 
                                    <td> <input class="form-control" type = 'submit' name = 'recurso' value = 'Fazer Melhoria/Recurso'> </td> 
                                <?php
                            }else{
                                    echo "<td class='bg-danger'> Impossível recuperar </td>";
                            }
                        ?> 
                        
                    </form>
                </tr>
                <?php
                $cont++;
            }
            ?>
            
            </table>

            <?php
            if ( $cont == 0 ) {
                $genero = $prova->GetAluno()->GetGenero();
				if ( $genero != 'M' ) {
					echo "<p style='color:white; background: blue' align='center'> Ainda não há notas lançadas da aluna ".$prova->GetAluno()->GetNome().'</p>';
				} else {
					echo "<p style='color:white; background: blue' align='center'> Ainda não há notas lançadas do aluno ".$prova->GetAluno()->GetNome().'</p>';
				}
            } else {
                $prova_dao->Media($prova);
            }

        } else {
            echo 'Impossível ver os resultados, não foi feito nenhuma prova';
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

    function Media($prova) {

        if ( $prova->GetAceite() == true ) {

            $prova->GetAluno()->SetRegisted( true );

            $con = GetConnection();

            $sql = 'select sum(nota), count(*) from pauta where id_aluno = ?';

            $stmt = $con->prepare( $sql );
            $stmt->bindValue( 1, $prova->GetAluno()->GetId() );
            $stmt->execute();
            $result = $stmt->fetchAll();

            ?>

            <table border = '2' align = 'center'>

            <tr bgcolor = '#004c14'>
            <th>Média Provisória</th>

            <?php	foreach ( $result as $value ) {
                ?>

                <?php

                $nota = ( $value[ 'sum(nota)' ] )/( $value[ 'count(*)' ] );
                $nota = number_format( $nota, 2 );
            }
            ?>
            <td bgcolor = '#004c14' align = 'center'><?php echo "<label style='color: #24fe00'> ".$nota.'v </label>' ?></td>

            <td>
                <?php
                    $prova->SetNota( $nota );
                    $prova_dao = new ProvaDao();
                    $prova_dao->PassedMedia($prova);

                    $notaFinal =  $prova->GetNota();
                    
                    $con = GetConnection();
                    $sql = 'select id_media from media where id_aluno = ?';
                    $stmt = $con->prepare( $sql );
                    $stmt->bindValue( 1, $prova->GetAluno()->GetId() );
                    $stmt->execute();
                    $id_media = $stmt->fetch();

                    if(empty($id_media)){
                        $con = GetConnection();
                        $sql = 'insert into media ( id_aluno, media_aluno) values( ?, ?)';
                        $stmt = $con->prepare( $sql );
                        $stmt->bindValue( 1, $prova->GetAluno()->GetId() );
                        $stmt->bindValue( 2, intval( $notaFinal ) );
                        $stmt->execute();
                    } else if(!empty($id_media)){
                        $sql = "update media 
                        set id_aluno = ?, 
                        media_aluno=? 
                        where id_media = ?";
                        $con = GetConnection();
                        $stmt = $con->prepare( $sql );
                        $stmt->bindValue( 1, $prova->GetAluno()->GetId() );
                        $stmt->bindValue( 2, $prova->GetNota() );
                        $stmt->bindValue( 3, $id_media["id_media"] );
                        $stmt->execute();
                    }
                    
                ?>
            </td>
            </tr>
            </table>

            <?php

        } else {

            echo 'Impossível ver os resultados, não foi feito nenhuma prova';

        }

    }

    function Passed($prova) {

        if ( $prova->GetAluno()->GetRegisted() == true ) {

            if ( $prova->GetAceite() == true && $prova->GetNota() >= 14 ) {

                echo "<label style='color: #24fe00'> Dispensado </label>";

            } elseif ( $prova->GetNota() >= 10 ) {

                echo "<label style='color: #00d7fe'> Aprovado </label>";

            } elseif ( $prova->GetNota() >= 7 ) {

                echo "<label style='color: #ff8585'> Melhoria de notas </label>";

            } else {

                echo "<label style='color: #fd6652'> Reprovado </label>";

            }

        } else {

            echo 'Precisa de ter provas feitas';

        }
    }

    function PassedMedia($prova) {

        if ( $prova->GetAluno()->GetRegisted() == true ) {
        /*
            if ( $prova->GetAceite() == true && $prova->GetNota() >= 14 ) {

                echo "<label style='color: #24fe00'> Dispensado </label>";

            } elseif ( $prova->GetNota() >= 10 ) {

                echo "<label style='color: #00d7fe'> Aprovado </label>";

            } elseif ( $prova->GetNota() >= 7 ) {

                echo "<label style='color: #ff8585'> Melhoria de notas </label>";

            } else {

                    echo "<label style='color: #fd6652'> Reprovado </label>";

            }
        */
        }
    }
}