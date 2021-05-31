<?php
require_once("Logsession.php");
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
        <link rel="shortcut icon" href="../Multimedia/Gura.png" type="image/x-icon">
        <title>MyWhatchedList</title>

        <meta property="og:imag" content="asuks.jpg">
        <meta property="og:desription" content="Quella volta che mi sono messo a preparare il mio esame di stasto con il covid che serpeggiava
        funesto per le strade dei pasesi, ricord uqel tempo come se fosse oggi stesso, sono uno speed runnero quindi farò tutto in 22 minuti e una brioche alla crema">
        <meta property="og:title" content="LongobardiArrapati">

        <link rel="stylesheet" href="../GraficaJava/Grafica.css">
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

        <main class="gbox1 reveal">
            <?php
            require_once("element_class.php");
            $elemento = new Elemento();
            // $sth = $pdo->prepare("SELECT * FROM 'utente' WHERE nome='$str'");
            $query = "SELECT *
                FROM elemento
                WHERE idCategoria=:id";
            $values = array(':id' => 2);
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

            $rows = $res->fetchAll();
            if ($rows) {
                foreach ($rows as $row) {


            ?>
                    <a href="Show.php?id=<?php echo $row['idElemento'] ?>">
                        <div align=center class="Copertina " style="float: left; background-image:url(../CaricareFILE/Cop/<?php
                                                                                                                            $query = "SELECT *
                                                                                                                                          FROM elemento
                                                                                                                                          WHERE titolo=:titolo";
                                                                                                                            $values = array(':titolo' => $row['titolo']);
                                                                                                                            try {
                                                                                                                                $res = $pdo->prepare($query);
                                                                                                                                $res->execute($values);
                                                                                                                            } catch (PDOException $e) {
                                                                                                                                /* If there is a PDO exception, throw a standard exception */
                                                                                                                                echo $e->getMessage();
                                                                                                                                throw new Exception('Errore Madornale');
                                                                                                                            }


                                                                                                                            if ($row['Copertina'] != NULL) {
                                                                                                                                echo htmlentities($row['Copertina']);
                                                                                                                            } else {
                                                                                                                                echo "no-cop.jpg";
                                                                                                                            }
                                                                                                                            ?>); background-size: cover;background-position: center;">
                            <p class="Titolo"><?php echo $row["titolo"]; ?></p>
                        </div>
                    </a>
            <?php
                }
            }

            ?>
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