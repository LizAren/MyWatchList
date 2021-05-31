<style>
 
    /* The dots/bullets/indicators */
    .dot {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
    }

    .active {
        background-color: #717171;
    }

    /* Fading animation */
    .fade {
        -webkit-animation-name: fade;
        -webkit-animation-duration: 1.5s;
        animation-name: fade;
        animation-duration: 1.5s;
    }

    @-webkit-keyframes fade {
        from {
            opacity: .4
        }

        to {
            opacity: 1
        }
    }

    @keyframes fade {
        from {
            opacity: .4
        }

        to {
            opacity: 1
        }
    }

    /* On smaller screens, decrease text size */
    @media only screen and (max-width: 300px) {
        .text {
            font-size: 11px
        }
    }
</style>





<div class="aside">
    <center>
        <h2>Più Visti:</h2>

<center>
        <div class="slideshow-container">

            <div class="mySlides fade">
                <?php
                require_once("element_class.php");
                $elemento = new Elemento();
                // $sth = $pdo->prepare("SELECT * FROM 'utente' WHERE nome='$str'");
                $query = "SELECT *
                FROM elemento
                WHERE idElemento=:id";
                $values = array(':id' => 54);
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
                            <div align=center class="Copertina" style="; background-image:url(../CaricareFILE/Cop/<?php
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
            </div>

            <div class="mySlides fade">
                <?php
                require_once("element_class.php");
                $elemento = new Elemento();
                // $sth = $pdo->prepare("SELECT * FROM 'utente' WHERE nome='$str'");
                $query = "SELECT *
                FROM elemento
                WHERE idElemento=:id";
                $values = array(':id' => 55);
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
                            <div align=center class="Copertina " style="; background-image:url(../CaricareFILE/Cop/<?php
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
            </div>

            <div class="mySlides fade">
                <?php
                require_once("element_class.php");
                $elemento = new Elemento();
                // $sth = $pdo->prepare("SELECT * FROM 'utente' WHERE nome='$str'");
                $query = "SELECT *
                FROM elemento
                WHERE idElemento=:id";
                $values = array(':id' => 56);
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
                            <div align=center class="Copertina" style="; background-image:url(../CaricareFILE/Cop/<?php
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
            </div>

        </div>
        <div style="text-align:center">
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
        </center>










        <h2>Seguiti:</h2>
        <table class="table table-striped">
            <tbody>


                <?php
                require_once("element_class.php");
                $elemento = new Elemento();
                // $sth = $pdo->prepare("SELECT * FROM 'utente' WHERE nome='$str'");
                $query = "SELECT DISTINCT *
                FROM elemento,segue,utente
                WHERE elemento.idElemento=segue.Idelemento AND segue.idUtente = utente.idUtente AND segue.idUtente=:utente";
                $values = array(':utente' => $account->getId());
                /* esecuzione query */
                try {
                    //prepare query
                    $res = $pdo->prepare($query);

                    //secuzione con passaggio di eventuali valori 
                    $res->execute($values);
                } catch (PDOException $e) {
                    //in caso di errore stampo con stile
                    echo $e->getMessage();
                    echo "Errore!";
                }

                $rows = $res->fetchAll();

                if ($rows) {
                    foreach ($rows as $row) {


                ?>
                        <tr style="text-align:left;">
                            <td>
                                <a href="Show.php?id=<?php echo $row['idElemento'] ?>" style="font-weight: lighter;"><b>|</b>

                                    <?php echo $row["titolo"]; ?>
                                </a>
                            </td>
                    <?php
                    }
                }

                    ?>

            </tbody>
        </table>
    </center>

</div>

<script>
    var slideIndex = 0;
    showSlides();

    function showSlides() {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
        setTimeout(showSlides, 5000); // Change image every 2 seconds
    }
</script>