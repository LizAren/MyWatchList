<?php

session_start();

require_once('include.php');
require_once('account_class.php');


$account = new Account();
$username=$_POST['UserName'];
$pass=$_POST['Pass'];
$nome=$_POST['Nome'];
$cognome=$_POST['Cognome'];

// crea account
// try
// {
// 	$newId = $account->addAccount($nome,$cognome,$username,$pass);
// }
// catch (Exception $e)
// {
// 	/* Something went wrong: echo the exception message and die */
// 	echo $e->getMessage();
// 	die();
// }

// echo 'The new account ID is ' . $newId;


// edita un account 
// $accountId = 16;

// try
// {
// 	$account->editAccount($accountId, 'Ton', 'qwertyqq', TRUE);
// }
// catch (Exception $e)
// {
// 	echo $e->getMessage();
// 	die();
// }

// echo 'Account edit successful.';


// elimina account
// $accountId = 18;

// try
// {
// 	$account->deleteAccount($accountId);
// }
// catch (Exception $e)
// {
// 	echo $e->getMessage();
// 	die();
// }

// echo 'Account delete successful.';



// log in con pass e user
// $login = FALSE;
// try
// {
// 	$login = $account->login($username, $pass);
// }
// catch (Exception $e)
// {
// 	echo $e->getMessage();
// 	die();

// }

// if ($login)
// {
// 	echo 'Authentication successful. <br>';
// 	echo 'Account ID: ' . $account->getId() . '<br>';
// 	echo 'Account name: ' . $account->getName() . '<br>';
// }
// else
// {
// 	echo 'Authentication failed.';
// }


// log sessione 
// $login = FALSE;

// try
// {
// 	$login = $account->sessionLogin();
// }
// catch (Exception $e)
// {
// 	echo $e->getMessage();
// 	die();
// }

// if ($login)
// {
// 	echo 'Authentication successful.';
// 	echo 'Account ID: ' . $account->getId() . '<br>';
// 	echo 'Account name: ' . $account->getName() . '<br>';
// }
// else
// {
// 	echo 'Authentication failed.';
// }

// log out con account 
// try
// {
// 	$login = $account->login('Alisia69', 'qwertyqq');
	
// 	if ($login)
// 	{
// 		echo 'Authentication successful.';
// 		echo 'Account ID: ' . $account->getId() . '<br>';
// 		echo 'Account name: ' . $account->getName() . '<br>';
// 	}
// 	else
// 	{
// 		echo 'Authentication failed.<br>';
// 	}
	
// 	$account->logout();
	
// 	$login = $account->sessionLogin();
	
// 	if ($login)
// 	{
// 		echo 'Authentication successful.';
// 		echo 'Account ID: ' . $account->getId() . '<br>';
// 		echo 'Account name: ' . $account->getName() . '<br>';
// 	}
// 	else
// 	{
// 		echo 'Authentication failed.<br>';
// 	}
// }
// catch (Exception $e)
// {
// 	echo $e->getMessage();
// 	die();
// }

// echo 'Logout successful.';

?>