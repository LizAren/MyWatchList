<?php
session_start();

require_once('include.php');
require_once('account_class.php');

$account = new Account();


if (isset($_POST['UserName']) && isset($_POST['Pass']) && isset($_POST['Nome']) && isset($_POST['Cognome']) && isset($_POST['Email'])) {
    $username = $_POST['UserName'];
    $pass = $_POST['Pass'];
    $nome = $_POST['Nome'];
    $cognome = $_POST['Cognome'];
    $email = $_POST['Email'];

    try {
        $newId = $account->addAccount($nome, $cognome, $email, $username, $pass);
    } catch (Exception $e) {
        /* Something went wrong: echo the exception message and die */
        echo $e->getMessage();
        die();
    }

    // log in gg no re 
    if (isset($_POST['UserName']) && isset($_POST['Pass'])) {
        $username = $_POST['UserName'];
        $pass = $_POST['Pass'];

        // log in con pass e user
        echo "Autenticazione <br>";
        $login = FALSE;
        try {
            $login = $account->login($username, $pass);
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }

        if ($login) {
            echo 'Authentication successful. <br>';
            echo 'Account ID: ' . $account->getId() . '<br>';
            echo 'Account name: ' . $account->getName() . '<br>';
        } else {
            echo 'Authentication failed.';
        }
    }

    // echo 'The new account ID is ' . $newId;
    header("Location:index.php");
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Multimedia/favico.svg" type="image/x-icon">
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="My Watch List"></script>
    <title>Registrati</title>



    <style>
        body {
            background-color: #324A5F;

        }

        form {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            margin: auto;
            margin-top: 7%;
            padding: 10px;
            border-radius: 15px;
            background-color: #0C1821;
            display: flex;
            flex-direction: column;
            width: 250px;

            color: white;
        }

        input[type=email],
        input[type=text],
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
            margin-top: 18px;
        }

        input[type=email],
        input[type=text],
        input[type=password]:focus {
            outline: 0px;
        }


        input[type=submit] {
            width: 50%;
            background-color: #7F8A9E;
            color: white;
            border: none;
            margin-top: 20px;
            border-radius: 25px;
            cursor: pointer;
            padding: 5px;
        }

        input[type=submit]:hover {
            background-color: #CCC9DC;
            transition: 0.4s;
        }


        a {
            text-decoration: none;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            color: #CACACA;
            font-weight: lighter;
            font-size: 14px;
            cursor: pointer;
        }

        .Logo {
            width: 60px;
            height: 60px;
        }
    </style>
</head>

<body>
    <center>
        <div class="reveal">
            <form action="register.php" method="POST">
                <center>
                    <img src="../Multimedia/LogoWhite.png" alt="Logo" class="Logo">
                </center>
                <h2>Registrati</h2>
                <input type="text" name="Nome" id="Nome" placeholder="Nome">
                <input type="text" name="Cognome" id="Cognome" placeholder="Cognome">
                <input type="Email" name="Email" id="Email" placeholder="Email">
                <input type="text" name="UserName" id="UserName" placeholder="UserName">
                <input type="password" name="Pass" id="pwd" placeholder="Password">
                <input style="background-image: url(../Multimedia/PssAye.png);  width: 11px;height: 11px; background-size: cover; border:none; border-radius:100%; margin-left: 90%; margin-top:-10%; margin-bottom:5%" type="button" onclick="showPwd()" value="">
                <center>
                    <input type="submit" name="submit" value="Register">
                </center>
            </form>
            <p><a href="Log.php">Torna alla schermata di log</a></p>
        </div>
    </center>


    <br>



</body>

</html>

<script>
    function showPwd() {
        var input = document.getElementById('pwd');
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }
</script>
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