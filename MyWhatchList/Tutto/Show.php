<?php
require_once("Logsession.php");
require_once('element_class.php');
require_once("account_class.php");
require_once('include.php');

$elemento = new Elemento;
?>


<!DOCTYPE html>
<html lang="it">

<head>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="LizAren">
        <meta name="description" content="sto provando a fare qualcosa e ad imaprarla seriamente ">

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="../Multimedia/favico.svg" type="image/x-icon">
        <title>MyWhatchedList</title>

        <meta property="og:imag" content="asuks.jpg">
        <meta property="og:desription" content="Quella volta che mi sono messo a preparare il mio esame di stasto con il covid che serpeggiava
        funesto per le strade dei pasesi, ricord uqel tempo come se fosse oggi stesso, sono uno speed runnero quindi farò tutto in 22 minuti e una brioche alla crema">
        <meta property="og:title" content="LongobardiArrapati">

        <link rel="stylesheet" href="../GraficaJava/Grafica.css">
        <script src="Java.js"></script>
        <script src="https://unpkg.com/scrollreveal"></script>
    </head>
</head>

<body>
    <!--Testa del tutto -->
    <!-- <header style="color: rgb(137, 43, 226); position: sticky;">
        <img src="../Multimedia/Gura.png" alt="Gura Gura" height="60px" width="60px">

    </header> -->
    <!--menù di navigazione-->

    <nav>
        <?php require_once('Nav.php') ?>
    </nav>

    <!--contenuto principale-->
    <div class="grid-wrapper">

        <main class="gbox1  <?php if(isset($_GET['action'])){ echo 'reveal'; }?>">
            <?php
            // prendo info da tabella elelemento
            if (isset($_GET['id'])) {
                $idElemento = $_GET['id'];
            } else if (isset($_GET['ID'])) {
                $idElemento = $_GET['ID'];
            } else if (isset($_GET['Id'])) {
                $idElemento = $_GET['Id'];
            } else if (isset($_GET['iD'])) {
                $idElemento = $_GET['iD'];
            }
            $query = "SELECT *
               FROM elemento
               WHERE idElemento=:titolo";
            $values = array(':titolo' => $idElemento);
            try {
                $res = $pdo->prepare($query);
                $res->execute($values);
            } catch (PDOException $e) {
                /* If there is a PDO exception, throw a standard exception */
                echo $e->getMessage();
                throw new Exception('Errore Madornale');
            }
            $row = $res->fetch();

            // prendo info da tabella autore
            $query = " SELECT *
                      FROM autore
                      WHERE idAutore=:id";
            $values = array(':id' => $row['idAutore']);
            try {
                $res = $pdo->prepare($query);
                $res->execute($values);
            } catch (PDOException $e) {
                /* If there is a PDO exception, throw a standard exception */
                echo $e->getMessage();
                throw new Exception('Errore Madornale Au');
            }
            $rowA = $res->fetch();
            // prendo info da tabella genere
            $query = " SELECT *
             FROM genere
             WHERE idGenere=:id";
            $values = array(':id' => $row['idgenere']);
            try {
                $res = $pdo->prepare($query);
                $res->execute($values);
            } catch (PDOException $e) {
                /* If there is a PDO exception, throw a standard exception */
                echo $e->getMessage();
                throw new Exception('Errore Madornale gen');
            }
            $rowG = $res->fetch();
            // prendo info da stagione
            $query = " SELECT *
             FROM stagione
             WHERE idElemento=:id";
            $values = array(':id' => $row['idElemento']);
            try {
                $res = $pdo->prepare($query);
                $res->execute($values);
            } catch (PDOException $e) {
                /* If there is a PDO exception, throw a standard exception */
                echo $e->getMessage();
                throw new Exception('Errore Madornale gen');
            }
            $rowS = $res->fetch();
            ?>
            <div align=center class="shower" style="float: left; background-image:url(../CaricareFILE/Cop/<?php

                                                                                                            if ($row['Copertina'] != NULL) {
                                                                                                                echo htmlentities($row['Copertina']);
                                                                                                            } else {
                                                                                                                echo "no-cop.jpg";
                                                                                                            }
                                                                                                            ?>); background-size: cover;background-position: center;">

            </div>
            <div style="padding-left:21%">
                <h2> <b>Titolo: </b><?php echo $row["titolo"]; ?></h2><br>
                <p>
                <p><b style="font-size: large;">Nome Autore:</b> <?php echo $rowA["nome"]; ?></p>
                </p>
                <p>
                <p><b style="font-size: large;">Cognome Autore:</b> <?php echo $rowA["cognome"]; ?></p>
                </p>
                <p>
                <p><b style="font-size: large;">Nazionalità:</b> <?php echo $rowA["nazione"]; ?></p>
                </p>
                <p>
                <div>
                    <p><b style="font-size: large;">Genere:</b> <?php echo $rowG["nome"]; ?></p>
                </div>
                <p><b style="font-size: large;">Episodi:</b> <?php echo $rowS["NEpisodi"]; ?></p>
                <p><b style="font-size: large;">Stagioni:</b> <?php echo $rowS["NStagione"]; ?></p><br>
                </p>
            </div>
            <div style="text-align:justify; padding:8px">
                <p name="Gestione"><b style="font-size: x-large;">Tram<a name="Gestione" href="#">a</a>:</b><br> <?php echo $row["trama"]; ?></p>
            </div><br><br><br><br>
            <div>

                <!-- aggiungi serie ed episodi  -->
                <a  href="ShowCode.php?id=<?php echo $row['idElemento'] ?>&action=follow" class="Aggiungi">
                    <?php
                    $query = 'SELECT idUtente FROM segue WHERE idElemento=:elemento AND idUtente=:utente';
                    $values = array(':elemento' => $row['idElemento'], ':utente' => $account->getId());
                    try {
                        $res = $pdo->prepare($query);
                        $res->execute($values);
                    } catch (PDOException $e) {
                        /* If there is a PDO exception, throw a standard exception */
                        echo $e->getMessage();
                        throw new Exception('Errore Madornale controllo ');
                    }
                    $rowC = $res->fetch();
                    if (isset($rowC['idUtente'])) {
                        echo 'Rimuovi';
                    } else echo 'Aggiungi';
                    ?>
                </a>
                <div class="Counter">
                    <?php
                    $query = 'SELECT Nepisodio FROM episodio  WHERE idElemento=:elemento AND idUtente=:utente';
                    $values = array(':elemento' => $row['idElemento'], ':utente' => $account->getId());
                    try {
                        $res = $pdo->prepare($query);
                        $res->execute($values);
                    } catch (PDOException $e) {
                        /* If there is a PDO exception, throw a standard exception */
                        echo $e->getMessage();
                        throw new Exception('Errore Madornale episodi ');
                    }
                    $rowE = $res->fetch();
                    if (isset($rowE['Nepisodio'])) {
                        if ($rowE['Nepisodio'] != 0) { ?>
                            <a name="Episodi" class="PalsMain" href="ShowCode.php?id=<?php echo $row['idElemento'] ?>&action=remove">  <img src="../Multimedia/minus.svg" alt="togli" style="width:14px;height:14px"></a> <?php
                                                                                                                        }
                                                                                                                    } ?>

                    <b> <?php

                        if (isset($rowE['Nepisodio'])) {
                            echo $rowE['Nepisodio'];
                        } else echo '0';

                        ?></b>
                    <?php
                    if (isset($rowE['Nepisodio'])) {
                        if ($rowE['Nepisodio'] != $rowS["NEpisodi"]) { ?>
                            <a class="PalsMain" href="ShowCode.php?id=<?php echo $row['idElemento'] ?>&action=add"><img src="../Multimedia/plus.svg" alt="togli" style="width:14px;height:14px"></a>
                        <?php
                        }
                    } else { ?> <a class="PalsMain" href="ShowCode.php?id=<?php echo $row['idElemento'] ?>&action=add"> <img src="../Multimedia/plus.svg" alt="togli" style="width:14px;height:14px"></a><?php } ?>
                </div>
                <br>
                <br><br><br>
            </div>
            <h1 align=center>DISCUSSION<a name="chat" href="#">E</a></h1>
            <div class="chat">
                <?php
                $query = "SELECT *
                          FROM chat
                          WHERE idElemento=:id"; 
                $values = array('id' => $row['idElemento']);
                /* esecuzione query */
                try {
                    //prepare query
                    $res = $pdo->prepare($query);

                    //secuzione con passaggio di eventuali valori 
                    $res->execute($values);
                } catch (PDOException $e) {
                    //in caso di errore stampo con stile
                    echo "Errore!";
                }

                $rowChat = $res->fetchAll();
                if ($rowChat) {
                    foreach ($rowChat as $rowCh) {

                ?>
               
                        <table style="margin-top: 5px;">
                            <tr>
                                <td>
                                    <?php
                                    $query = "SELECT username
                                 FROM utente
                                 WHERE idUtente=:id";
                                    $values = array('id' => $rowCh['idUtente']);
                                    /* esecuzione query */
                                    try {
                                        //prepare query
                                        $res = $pdo->prepare($query);

                                        //secuzione con passaggio di eventuali valori 
                                        $res->execute($values);
                                    } catch (PDOException $e) {
                                        //in caso di errore stampo con stile
                                        echo "Errore!";
                                    }

                                    $rowUt = $res->fetch();
                                    echo '<b style="color:#7F8A9E">'. $rowUt['username']." </b>";
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $rowCh['messaggio'] ?></td>
                            </tr>
                        </table>
                <?php }
                } ?>
            </div>
            <center>

                <form action="ShowCode.php?id=<?php echo $row['idElemento'] ?>&action=message" method="POST">
                    <input type="text" class="chatIn" name="message" id="message" placeholder="Messaggio">
                    <input class="ChatSand" type="submit" name="invioM" alt="Invia" value=".">
                </form>
            </center>
        </main>

        <aside class="gbox2 reveal">
            <?php require_once('Aside.php'); ?>
        </aside>
        <footer class="gbox3">
            <?php require_once('footer.html') ?>
        </footer>
    </div>
    <!-- chat sulla serie, tentativo 1 -->

</body>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.2/flickity.pkgd.min.js" integrity="sha512-cA8gcgtYJ+JYqUe+j2JXl6J3jbamcMQfPe0JOmQGDescd+zqXwwgneDzniOd3k8PcO7EtTW6jA7L4Bhx03SXoA==" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        /* Open Panel */
        $(".hamburger").on('click', function() {
            $(".menu").toggleClass("menu--open");
        });


    });

    ScrollReveal().reveal('.reveal', {
        distance: '100px',
        duration: 1500,
        easing: 'cubic-bezier(.215, .61, .355, 1)',
        interval: 600
    });
    ScrollReveal().reveal('.zoom', {
        duration: 1500,
        easing: 'cubic-bezier(.215, .61, .355, 1)',
        interval: 200,
        scale: 0.65,
        mobile: false
    });
</script>





<html>

