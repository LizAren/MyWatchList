<?php
session_start();
require_once('include.php');
require_once('account_class.php');


$account = new Account();

$login = FALSE;

try {
    $login = $account->sessionLogin();
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}

if ($login) {
    // echo 'Authentication successful.';
    // echo 'Account ID: ' . $account->getId() . '<br>';
    // echo 'Account name: ' . $account->getName() . '<br>';
} else {
    echo 'Authentication failed.';
    header('location:Log.php');
}
?>