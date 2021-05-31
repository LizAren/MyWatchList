<?php
require_once("Logsession.php");
require_once('element_class.php');
require_once("account_class.php");
require_once('include.php');
// passo messagfgio per chat 
if (isset($_GET['action']) && $_GET['action'] == 'message') {
    $message = $_POST['message'];
    $query = 'INSERT INTO mywatchlist.chat (idElemento, idUtente,messaggio) VALUES (:elemento, :utente,:messaggio)';
    $values = array(':elemento' => $_GET['id'], ':utente' => $account->getId(), ':messaggio' => $message);
    try {
        $res = $pdo->prepare($query);
        $res->execute($values);
    } catch (PDOException $e) {
        /* If there is a PDO exception, throw a standard exception */
        echo $e->getMessage();
        throw new Exception('Errore Madornale inserimento messaggio');
    }
    header("location:Show.php?id=" . $_GET['id']."#chat");
}





if (isset($_GET['action']) && $_GET['action'] == 'follow') {
    $query = 'SELECT idUtente FROM segue WHERE idElemento=:elemento AND idUtente=:utente';
    $values = array(':elemento' => $_GET['id'], ':utente' => $account->getId());
    try {
        $res = $pdo->prepare($query);
        $res->execute($values);
    } catch (PDOException $e) {
        /* If there is a PDO exception, throw a standard exception */
        echo $e->getMessage();
        throw new Exception('Errore Madornale validazione ');
    }
    $rowC = $res->fetch();
    if (isset($rowC['idUtente'])) {
        $query = 'DELETE FROM segue WHERE idElemento=:elemento AND idUtente=:utente';
        $values = array(':elemento' => $_GET['id'], ':utente' => $account->getId());
        try {
            $res = $pdo->prepare($query);
            $res->execute($values);
        } catch (PDOException $e) {
            /* If there is a PDO exception, throw a standard exception */
            echo $e->getMessage();
            throw new Exception('Errore Madornale validazione ');
        }
        $query = 'DELETE FROM episodio WHERE idElemento=:elemento AND idUtente=:utente';
        $values = array(':elemento' => $_GET['id'], ':utente' => $account->getId());
        try {
            $res = $pdo->prepare($query);
            $res->execute($values);
        } catch (PDOException $e) {
            /* If there is a PDO exception, throw a standard exception */
            echo $e->getMessage();
            throw new Exception('Errore Madornale validazione ');
        }
        header("location:Show.php?id=" . $_GET['id']."#Gestione");
    } else {
        $idUtente = $account->getId();

        $idEl = $_GET['id'];

        // collego elemento ad utente 
        $query = 'INSERT INTO mywatchlist.segue (idElemento, idUtente) VALUES (:elemento, :utente)';
        $values = array(':elemento' => $idEl, ':utente' => $idUtente);
        try {
            $res = $pdo->prepare($query);
            $res->execute($values);
        } catch (PDOException $e) {
            /* If there is a PDO exception, throw a standard exception */
            echo $e->getMessage();
            throw new Exception('Errore Madornale segue');
        }
        $rowS = $res->fetch();
        // collego elemento ad episodio
        $query = 'INSERT INTO mywatchlist.episodio (idElemento, idUtente) VALUES (:elemento, :utente)';
        $values = array(':elemento' => $idEl, ':utente' => $idUtente);
        try {
            $res = $pdo->prepare($query);
            $res->execute($values);
        } catch (PDOException $e) {
            /* If there is a PDO exception, throw a standard exception */
            echo $e->getMessage();
            throw new Exception('Errore Madornale segue');
        }
        header("location:Show.php?id=" . $_GET['id']."#Gestione");
    }
}
if (isset($_GET['action']) && $_GET['action'] == 'add') {
    $query = 'SELECT Nepisodio FROM episodio  WHERE idElemento=:elemento AND idUtente=:utente';
    $values = array(':elemento' => $_GET['id'], ':utente' => $account->getId());
    try {
        $res = $pdo->prepare($query);
        $res->execute($values);
    } catch (PDOException $e) {
        /* If there is a PDO exception, throw a standard exception */
        echo $e->getMessage();
        throw new Exception('Errore Madornale episodi ');
    }
    $rowW = $res->fetch();
    if (isset($rowW['Nepisodio'])) {
        $temp = $rowW['Nepisodio'];
        $temp = $temp + 1;
        $query = 'UPDATE episodio SET Nepisodio=:temp  WHERE idElemento=:elemento AND idUtente=:utente';
        $values = array(':temp' => $temp, ':elemento' => $_GET['id'], ':utente' => $account->getId());
        try {
            $res = $pdo->prepare($query);
            $res->execute($values);
        } catch (PDOException $e) {
            /* If there is a PDO exception, throw a standard exception */
            echo $e->getMessage();
            $e->getMessage();
            throw new Exception('Errore Madornale episodi ');
        }
        // $_GET['id'] = $_GET['Id'];
        // aggiungo episodio se non segu 
        header("location:Show.php?id=" . $_GET['id']."#Gestione");
    } else {
        $idUtente = $account->getId();

        $idEl = $_GET['id'];

        // collego elemento ad utente 
        $query = 'INSERT INTO mywatchlist.segue (idElemento, idUtente) VALUES (:elemento, :utente)';
        $values = array(':elemento' => $idEl, ':utente' => $idUtente);
        try {
            $res = $pdo->prepare($query);
            $res->execute($values);
        } catch (PDOException $e) {
            /* If there is a PDO exception, throw a standard exception */
            echo $e->getMessage();
            throw new Exception('Errore Madornale segue');
        }
        $rowS = $res->fetch();
        // collego elemento ad utente 
        $query = 'INSERT INTO mywatchlist.episodio (idElemento, idUtente) VALUES (:elemento, :utente)';
        $values = array(':elemento' => $idEl, ':utente' => $idUtente);
        try {
            $res = $pdo->prepare($query);
            $res->execute($values);
        } catch (PDOException $e) {
            /* If there is a PDO exception, throw a standard exception */
            echo $e->getMessage();
            throw new Exception('Errore Madornale segue');
        }
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
        $rowW = $res->fetch();
        // collego elemento ad episodio
        $temp = $rowW['Nepisodio'];
        $temp = $temp + 1;
        $query = 'UPDATE episodio SET Nepisodio=:temp  WHERE idElemento=:elemento AND idUtente=:utente';
        $values = array(':temp' => $temp, ':elemento' => $row['idElemento'], ':utente' => $account->getId());
        try {
            $res = $pdo->prepare($query);
            $res->execute($values);
        } catch (PDOException $e) {
            /* If there is a PDO exception, throw a standard exception */
            echo $e->getMessage();
            throw new Exception('Errore Madornale segue');
        }
        header("location:Show.php?id=" . $_GET['id']."#Gestione");
    };
} else if (isset($_GET['action']) && $_GET['action'] == 'remove') {
    $query = 'SELECT Nepisodio FROM episodio  WHERE idElemento=:elemento AND idUtente=:utente';
    $values = array(':elemento' => $_GET['id'], ':utente' => $account->getId());
    try {
        $res = $pdo->prepare($query);
        $res->execute($values);
    } catch (PDOException $e) {
        /* If there is a PDO exception, throw a standard exception */
        echo $e->getMessage();
        throw new Exception('Errore Madornale episodi ');
    }
    $rowE = $res->fetch();
    $temp = $rowE['Nepisodio'];
    $temp = $temp - 1;
    $query = 'UPDATE episodio SET Nepisodio=:temp  WHERE idElemento=:elemento AND idUtente=:utente';
    $values = array(':temp' => $temp, ':elemento' => $_GET['id'], ':utente' => $account->getId());
    try {
        $res = $pdo->prepare($query);
        $res->execute($values);
    } catch (PDOException $e) {
        /* If there is a PDO exception, throw a standard exception */
        echo $e->getMessage();
        $e->getMessage();
        throw new Exception('Errore Madornale episodi ');
    }
    // $_GET['id'] = $_GET['iD'];
    header("location:Show.php?id=" . $_GET['id']."#Gestione");
}
