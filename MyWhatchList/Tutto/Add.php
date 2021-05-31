<?php
require_once("Logsession.php");
require_once("element_class.php");
$elemento = new Elemento();
if (isset($_POST['Aggiorna'])) {
    $titolo = $_POST['Titolo'];
    $trama = $_POST['Trama'];
    $stato = $_POST['Stato'];
    $nomeau = $_POST['NomeAu'];
    $cognau = $_POST['CognAu'];
    $nascita = $_POST['DataAu'];
    $nazione = $_POST['Nazione'];
    $categoria = $_POST['Categoria'];
    if (isset($_POST['Genere'])) {
        $gen = $_POST['Genere'];
    }else{
        $gen =array('.');
    }
    $nep= $_POST['NEp'];
    $ns=$_POST['NS'];

    $genere = "";
    foreach ($gen as $gen1) {
        $genere .= $gen1 . ",";
    }
    if ($stato == 'In Corso') {
        $stato = 1;
    } else {
        $stato = 0;
    }
    $elemento->AdElemento($titolo, $trama, $_FILES['Copertina'], $stato, $nomeau, $cognau, $nazione, $nascita, $categoria, $genere,$nep,$ns);
    header("Location:index.php");
}




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
        <script src="https://unpkg.com/scrollreveal"></script>
        <title>MyWhatchedList</title>

        <meta property="og:imag" content="asuks.jpg">
        <meta property="og:desription" content="Quella volta che mi sono messo a preparare il mio esame di stasto con il covid che serpeggiava
        funesto per le strade dei pasesi, ricord uqel tempo come se fosse oggi stesso, sono uno speed runnero quindi farò tutto in 22 minuti e una brioche alla crema">
        <meta property="og:title" content="LongobardiArrapati">

        <link rel="stylesheet" href="../GraficaJava/Grafica.css">
        <script src="Java.js"></script>
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

        <main class="gbox1 reveal">
            <div style="padding: 13px;padding-top:70px">
                <form action="Add.php" method="POST" enctype="multipart/form-data">
                    <!-- dati sulla serie stessa  -->
                    <div class="AdCop" align=center>
                        <label for="Copertina">Copertina</label><br>
                        <input type="file" name="Copertina" id="txt"><br>
                    </div>
                    <div class="AdTitolo">
                        <label for="Titolo">Titolo*</label><br>
                        <input class="Testo" type="text" name="Titolo" id="Titolo" required>
                    </div>
                    <br>
                    <div align=center class="AdTrama">
                        <label for="Trama">Trama</label><br>
                        <textarea class="Trama" class="Testo" name="Trama" id="Trama" cols="100" rows="13"></textarea>
                    </div>

                    <div class="AdEp" align=center>
                        <label for="NEp">Numero Episodi*</label><br>
                        <input class="Testo"  type="number" id="NEp" name="NEp" min="1" required><br><br><br><br><br>
                        <label for="NS"> Numero Stagioni*</label><br>
                        <input class="Testo" type="number" id="NEp" name="NS" min="1" required><br>
                    </div>
                    <div class="AdGenere">
                        <div class="Genere Tit">
                            <label for="Stato">Genere</label><br>
                        </div>
                        <div class="Genere">
                            <input type="checkbox" id="genere" name="Genere[]" value="Avventura">
                            <label for="In Corso">Avventura</label><br>
                            <input type="checkbox" id="genere" name="Genere[]" value="Azione">
                            <label for="Azione">Azione</label><br>
                            <input type="checkbox" id="genere" name="Genere[]" value="Biografico">
                            <label for="In Corso">Biografico</label><br>
                            <input type="checkbox" id="genere" name="Genere[]" value="Comico">
                            <label for="In Corso">Comico</label><br>
                            <input type="checkbox" id="genere" name="Genere[]" value="Comico">
                            <label for="In Corso">Commedia</label><br>
                            <input type="checkbox" id="genere" name="Genere[]" value="Demenziale">
                            <label for="In Corso">Demenziale</label><br>
                            <input type="checkbox" id="genere" name="Genere[]" value="Documentario">
                            <label for="In Corso">Documentario</label><br>
                            <input type="checkbox" id="genere" name="Genere[]" value="Dramma">
                            <label for="In Corso">Dramma</label><br>
                            <input type="checkbox" id="genere" name="Genere[]" value="Fantascienza">
                            <label for="In Corso">Fantascienza</label><br>
                            <input type="checkbox" id="genere" name="Genere[]" value="Erotico">
                            <label for="In Corso">Erotico</label><br>
                            <input type="checkbox" id="genere" name="Genere[]" value="Fantasy">
                            <label for="In Corso">Fantasy</label><br>
                            <input type="checkbox" id="genere" name="Genere[]" value="Giallo">
                            <label for="In Corso">Giallo</label><br>
                            <input type="checkbox" id="genere" name="Genere[]" value="Guerra">
                            <label for="In Corso">Guerra</label><br>
                            <input type="checkbox" id="genere" name="Genere[]" value="Horror">
                            <label for="In Corso">Horror</label><br>
                            <input type="checkbox" id="genere" name="Genere[]" value="Musical">
                            <label for="In Corso">Musical</label><br>
                            <input type="checkbox" id="genere" name="Genere[]" value="Poliziesco">
                            <label for="In Corso">Poliziesco</label><br>
                            <input type="checkbox" id="genere" name="Genere[]" value="Storico">
                            <label for="In Corso">Storico</label><br>
                            <input type="checkbox" id="v" name="Genere[]" value="SuperEroi">
                            <label for="In Corso">SuperEroi</label><br>
                            <input type="checkbox" id="genere" name="Genere[]" value="Thriller">
                            <label for="In Corso">Thriller</label><br>
                            <input type="checkbox" id="genere" name="Genere[]" value="Wenstern">
                            <label for="In Corso">Western</label><br>
                        </div>
                    </div>

                    <div style="clear: both; padding:20px;margin-top: 470px;margin-bottom:40px;font-weight: 900;">
                        <div style="float: left;">
                            <label for="Stato">Stato*:</label>
                            <input type="radio" id="In Corso" name="Stato" value="In Corso" checked>
                            <label for="In Corso">In Corso</label>
                            <input type="Radio" id="Finito" name="Stato" value="Finito">
                            <label for="Finito">Finito</label><br>
                        </div>
                        <div style="float:right">
                            <label for="Stato">Categoria*:</label>
                            <input class="Testo" type="radio" id="Anime" name="Categoria" value="Anime" checked>
                            <label for="In Corso">Anime</label>
                            <input class="Testo" type="radio" id="SerieTv" name="Categoria" value="SerieTv">
                            <label for="In Corso">SerieTv</label>
                            <input class="Testo" type="Radio" id="Film" name="Categoria" value="Film">
                            <label for="Finito">Film</label><br>
                            <input class="Testo" type="Radio" id="Animazione" name="Categoria" value="Animazione">
                            <label for="Finito">Animazione</label><br>
                        </div>
                    </div>
                    <!-- dati sul autore della serie  -->
                    <div style="clear: both;font-weight: 900;" align=center>
                        <label for="NomeAu">Nome Autore*</label><br>
                        <input class="Testo" type="text" name="NomeAu" id="NomeAu" required><br>
                        <label for="CognAu">Cognome Autore*</label><br>
                        <input class="Testo" type="text" name="CognAu" id="CognAu" required><br>
                        <label for="DataAu">Data Nascita Autore*</label><br>
                        <input class="Testo" type="date" name="DataAu" id="DataAu" min="1940-01-01" max="2002-01-01" required> <br>
                        <label for="Nazione">Nazionalità</label><br>
                        <input class="Testo" type="text" name="Nazione" id="Nazione"><br>
                    </div>


                    <br>
                    <div align=center>
                        <input class="AdSerie" type="submit" name="Aggiorna" value="Agggiungi">
                    </div>
                </form>
            </div>
        </main>

        <aside class="gbox2 reveal">
        <?php require_once('Aside.php'); ?>
        </aside>
        <footer class="gbox3">
        <?php require_once('footer.html') ?>
        </footer>
    </div>
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