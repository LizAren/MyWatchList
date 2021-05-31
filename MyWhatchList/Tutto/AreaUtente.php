<?php
require_once("Logsession.php");
require_once('account_class.php');
require_once('include.php');



if (isset($_POST['Rimuovi'])) {
    $id = $account->getId();
    $account->removeAvatar($id);
    header("Refresh:0");
} else if (isset($_POST['Aggiorna'])) {
    $username = $_POST['UserName'];
    $pass = $_POST['Pass'];
    $nome = $_POST['Nome'];
    $cognome = $_POST['Cognome'];
    $email = $_POST['Email'];
    $attivo = $account->getAttiv();
    $accountId = $account->getId();
    try {
        $account->editAccount($accountId, $nome, $cognome, $email, $username, $pass, $attivo);
    } catch (Exception $e) {
        echo $e->getMessage();
        die();
    }
    header("Refresh:0");
} else if (isset($_POST['Carica'])) {
    echo "1 porta del cambio";
    if (isset($_FILES['photo'])) {
        echo "aggiorno";
        if ($_FILES['photo']['size'] > 0) {
            echo "cambio";
            $id = $account->getId();
            //     $avatar = $_POST['photo'];

            //     $uploded = FALSE;
            // echo "variabili definite";
            //     try {
            //         $uploded = $account->editAvatar($id, $avatar);
            // echo "try fatto";
            //     } catch (Exception $e) {
            //         echo $e->getMessage();
            //         die();
            //     }
            $account->editAvatar($id, $_FILES['photo']);

            header("Refresh:0");
        }
    }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="LizAren">
    <meta name="description" content="sto provando a fare qualcosa e ad imaprarla seriamente ">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../Multimedia/favico.svg" type="image/x-icon">
    <title>Area Utente</title>

    <meta property="og:imag" content="asuks.jpg">
    <meta property="og:desription" content="Quella volta che mi sono messo a preparare il mio esame di stasto con il covid che serpeggiava
        funesto per le strade dei pasesi, ricord uqel tempo come se fosse oggi stesso, sono uno speed runnero quindi farò tutto in 22 minuti e una brioche alla crema">
    <meta property="og:title" content="LongobardiArrapati">
    <script src="https://unpkg.com/scrollreveal"></script>
    <link rel="stylesheet" href="../GraficaJava/Grafica.css">
</head>

<style>
    .ImgCange {
        display: flex;
        flex-direction: column;
        float: left;
        align-items: center;
    }

    main form {
        text-align: left;
        font-weight: 600;
        margin-left: 10px;
        color: white;
        display: flex;
        flex-direction: column;
        width: 400px;


    }
    main input[type=text],
    input[type=email],
    input[type=password] {
        margin: 8px 0;
        line-height: 1.5;
        display: inline-block;
        border: 1px solid #ccc;
        box-shadow: inset 0 1px 3px #ddd;
        border-radius: 8px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        margin-top: 30px;
    }

    input[type=text],
    input[type=password]:focus {
        outline: 0px;
    }

label{
    font-size: small;
}

    main input[type=submit] {
        width: 50%;
        background-color: #7F8A9E;
        color: white;
        border: none;
        margin-top: 20px;
        border-radius: 8px;
        cursor: pointer;
        padding: 5px;
    }

    main input[type=submit]:hover {
        background-color: #CCC9DC;
        transition: 0.4s;
    }


</style>

<body>
    <nav>
        <?php require("Nav.php") ?>
    </nav>
    <div class="grid-wrapper">

        <main class="gbox1 reveal">

            <div class="ImgCange reveal" style="margin-top: 80px;">
                <img src="../CaricareFILE/upload/<?php
                                                    if ($account->getAvatar() != NULL) {
                                                        echo htmlentities($account->getAvatar());
                                                    } else {
                                                        echo "no-avatar.jpg";
                                                    }
                                                    ?>" class="ProPic" alt="FileNotFound">

                <form style="width: 250px;" action="AreaUtente.php" method="POST" enctype="multipart/form-data">
                <center>
                    <input type="file" name="photo" id="txt">
                    <input style="width: 80%;" type="submit" name="Carica" id="Carica" value="Cambia">
                    <input  type="submit" name="Rimuovi" id="Rimuovi" value="Rimuovi">
                    </center>
                </form>
                <p align=center style="font-size:small;"><b>Nota:</b> Accettati <b>SOLO</b> formati <br> jpg, gif, png; con massime <br> dimensioni 3mb </p>
            </div>
            <div align=center style="margin-top: 80px;margin-bottom:20px">
                <form action="AreaUtente.php" method="POST" class="reveal ">
                    
                    <input type="text" name="Nome" id="Nome" value="<?php echo $account->getName() ?>">
                    <label for="Nome">Nome</label>
                    
                    <input type="text" name="Cognome" id="Cognome" value="<?php echo $account->getCognome() ?>">
                    <label for="Cognome">Cognome</label>
                   
                    <input type="Email" name="Email" id="Email " value="<?php echo $account->getEmail() ?>">
                    <label for="Email">Email</label>
                    
                    <input type="text" name="UserName" id="UserName" value="<?php echo $account->getUser() ?>">
                    <label for="UserName">UserName</label>
                    
                    <input type="password" name="Pass" id="pwd" required>
                    <label for="Pass">Password:</label>
                    <input style="background-image: url(../Multimedia/PssAye.png); width: 14px;height: 14px;
         background-size: cover;
         border:none;
         border-radius:100%;
         margin-left: 90%;
         margin-top:-10.5%;
         margin-bottom:5%" type="button" onclick="showPwd()" value="">
         <center>
         <input type="submit" name="Aggiorna" value="Aggiorna">
         </center>
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

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.2/flickity.pkgd.min.js" integrity="sha512-cA8gcgtYJ+JYqUe+j2JXl6J3jbamcMQfPe0JOmQGDescd+zqXwwgneDzniOd3k8PcO7EtTW6jA7L4Bhx03SXoA==" crossorigin="anonymous"></script>

<script>
    function showPwd() {
        var input = document.getElementById('pwd');
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }


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