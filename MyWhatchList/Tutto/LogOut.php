<?php
session_start();

require_once('include.php');
require_once('account_class.php');


$account = new Account();

try
{
	$login = $account->login('Alisia69', 'qwertyqq');
	
	if ($login)
	{
		echo 'Authentication successful.';
		echo 'Account ID: ' . $account->getId() . '<br>';
		echo 'Account name: ' . $account->getName() . '<br>';
	}
	else
	{
		echo 'Authentication failed.<br>';
	}
	
	$account->logout();
	
	$login = $account->sessionLogin();
	
	if ($login)
	{
		echo 'Authentication successful.';
		echo 'Account ID: ' . $account->getId() . '<br>';
		echo 'Account name: ' . $account->getName() . '<br>';
	}
	else
	{
		echo 'Authentication failed.<br>';
	}
}
catch (Exception $e)
{
	echo $e->getMessage();
	die();
}

echo 'Logout successful.';
header("location: Log.php")


?>