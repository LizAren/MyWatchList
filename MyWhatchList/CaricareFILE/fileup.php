<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>File php</title>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            font-size: 15px;
            line-height: 1.5;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        form {
            margin-top: 15%;
            display: flex;
            flex-direction: column;
            width: 300px;
            padding: 50px;
        }

        input[type=text] {
            margin: 8px 0;
            width: 100%;
            line-height: 1.5;
            display: inline-block;
            border: 1px solid #ccc;
            box-shadow: inset 0 1px 3px #ddd;
            border-radius: 4px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding-left: 20px;
            padding-right: 20px;
            padding-top: 12px;
            padding-bottom: 12px;
        }


        input[type=submit] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            border: none;
            margin: 8px;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>

</head>

<body>

    <form action="fileup.php" method="POST" enctype="multipart/form-data">
        <h1>UPLoad File</h1>
        <label for="fileSelect">File:</label>
        <input type="file" name="photo" id="txt">
        <input type="submit" name="submit" value="Carica">
        <!-- <p><b>Nota:</b> Accettati <b>SOLO</b> formati jpg, jpeg, gif, png; max dim 5m </p> -->
    </form>

</body>

</html>


<?php
session_start();
require_once('../identificazione/account_class.php');
require_once('include.php');

echo "sono nel sistema";
$account = new Account();


if ($_FILES['photo']['size']>0) {
//     $avatar = $_POST['photo'];
    $id = 57;
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
}


?>