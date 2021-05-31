<?php

require_once('include.php');

class Account
{
    /* Class properties (variables) */

    /* The ID of the logged in account (or NULL if there is no logged in account) */
    private $id;


    /* nome dell'utente loggato */
    private $name;

    // nikname utente loggato
    private $username;

    // cognome del utente 
    private $surname;

    /* avatar dell'utente loggato */
    private $avatar;

    /* TRUE se autenticato, FALSE altrimenti */
    private $authenticated;

    // email dello gnaro loggato
    private $email;


    private $pass;

    private $intEnabled;
    /* Public class methods (functions) */

    /* Constructor */
    public function __construct()
    {
        /* Initialize the $id and $name variables to NULL */
        $this->id = NULL;
        $this->name = NULL;
        $this->authenticated = FALSE;
    }

    /* Destructor */
    public function __destruct()
    {
    }


    public function getName()
    {
        return $this->name;
    }

    public function getCognome()
    {
        return $this->surname;
    }

    public function getUser()
    {
        return $this->username;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPass()
    {
        return $this->pass;
    }

public function getAttiv(){
    return $this->intEnabled;
}


    public function isEmailValid(string $email): bool
    {
        $valid = TRUE;
        // Remove all illegal characters from email
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        // Validate e-mail
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $valid = FALSE;
        }
        $whiteList = 'ABCDEFGHILMNOPQRSTUVZJKWYabcdefghijklmnopqrstuvwxyz1234567890.@';

        for ($i = 0; $i < mb_strlen($email); $i++) {
            $char = mb_substr($email, $i, 1);

            if (mb_strpos($whiteList, $char) === FALSE) {
                $valid = FALSE;
            }
        }

        return $valid;
    }









    /* A sanitization check for the account username */
    public function isNameValid(string $name): bool
    {
        /* Initialize the return variable */
        $valid = TRUE;

        /* Example check: the length must be between 2 and 20 chars */
        $len = mb_strlen($name);

        if (($len < 2) || ($len > 20)) {
            $valid = FALSE;
        }

        $whiteList = 'ABCDEFGHILMNOPQRSTUVZJKWYabcdefghijklmnopqrstuvwxyz1234567890.@';

        for ($i = 0; $i < mb_strlen($name); $i++) {
            $char = mb_substr($name, $i, 1);

            if (mb_strpos($whiteList, $char) === FALSE) {
                $valid = FALSE;
            }
        }

        /* You can add more checks here */

        return $valid;
    }

    /* A sanitization check for the account password */
    public function isPasswdValid(string $passwd): bool
    {
        /* Initialize the return variable */
        $valid = TRUE;

        /* Example check: the length must be between 8 and 16 chars */
        $len = mb_strlen($passwd);

        if (($len < 8) || ($len > 30)) {
            $valid = FALSE;
        }

        /* You can add more checks here */

        return $valid;
    }

    /* Returns the account id having $name as name, or NULL if it's not found */
    public function getIdFromName(string $name): ?int
    {
        /* Global $pdo object */
        global $pdo;

        /* Since this method is public, we check $name again here */
        if (!$this->isNameValid($name)) {
            throw new Exception('Invalid user name');
        }

        /* Initialize the return value. If no account is found, return NULL */
        $id = NULL;

        /* Search the ID on the database */
        $query = 'SELECT idUtente FROM mywatchlist.utente WHERE (username = :name)';
        $values = array(':name' => $name);
        try {
            $res = $pdo->prepare($query);
            $res->execute($values);
        } catch (PDOException $e) {
            /* If there is a PDO exception, throw a standard exception */
            throw new Exception('Database query error 1');
        }

        $row = $res->fetch(PDO::FETCH_ASSOC);

        /* There is a result: get it's ID */
        if (is_array($row)) {
            $id = intval($row['idUtente'], 10);
        }

        return $id;
    }






    /* A sanitization check for the account ID */
    public function isIdValid(int $id): bool
    {
        /* Initialize the return variable */
        $valid = TRUE;

        /* Example check: the ID must be between 1 and 1000000 */

        if (($id < 1) || ($id > 1000000)) {
            $valid = FALSE;
        }

        /* You can add more checks here */

        return $valid;
    }









    /* Add a new account to the system and return its ID (the account_id column of the accounts table) */
    public function addAccount(string $name, string $surname, string $email, string $username, string $passwd): int
    {
        /* Global $pdo object */
        global $pdo;

        /* Trim the strings to remove extra spaces */
        $name = trim($name);
        $passwd = trim($passwd);
        $username = trim($username);
        $surname = trim($surname);
        $email = trim($email);

        /* Check if the user name is valid. If not, throw an exception */
        if (!$this->isNameValid($name)) {
            throw new Exception('Invalid user name');
        }
        if (!$this->isNameValid($surname)) {
            throw new Exception('Invalid user surname');
        }
        if (!$this->isEmailValid($email)) {
            throw new Exception('Invalid Email');
        }
        if (!$this->isNameValid($username)) {
            throw new Exception('Invalid username');
        }

        /* Check if the password is valid. If not, throw an exception */
        if (!$this->isPasswdValid($passwd)) {
            throw new Exception('Invalid password');
        }

        /* Check if an account having the same name already exists. If it does, throw an exception */
        if (!is_null($this->getIdFromName($username))) {
            throw new Exception('Username not available');
        }

        /* Finally, add the new account */

        /* Insert query template */
        $query = 'INSERT INTO mywatchlist.utente (nome, cognome, username , pass, Email ) VALUES (:name, :surname, :username,  :passwd, :Email)';
        /* Password hash */
        $hash = password_hash($passwd, PASSWORD_DEFAULT);

        /* Values array for PDO */
        $values = array(':name' => $name, ':surname' => $surname, ':username' => $username, ':passwd' => $hash, ':Email' => $email);

        /* Execute the query */
        try {
            $res = $pdo->prepare($query);

            $res->execute($values);
        } catch (PDOException $e) {
            echo $e->getMessage();
            /* If there is a PDO exception, throw a standard exception */
            throw new Exception('Database query error 2');
        }

        /* Return the new ID */
        return $pdo->lastInsertId();
    }





    /* Edit an account (selected by its ID). The name, the password and the status (enabled/disabled) can be changed */
    public function editAccount(int $id,string $name, string $surname, string $email, string $username, string $passwd, int $enabled)
    {
        /* Global $pdo object */
        global $pdo;

        /* Trim the strings to remove extra spaces */
        $name = trim($name);
        $passwd = trim($passwd);
        $username = trim($username);
        $surname = trim($surname);
        $email = trim($email);

        /* Check if the ID is valid */
        if (!$this->isNameValid($name)) {
            throw new Exception('Invalid user name');
        }
        if (!$this->isNameValid($surname)) {
            throw new Exception('Invalid user surname');
        }
        if (!$this->isEmailValid($email)) {
            throw new Exception('Invalid Email');
        }
        if (!$this->isNameValid($username)) {
            throw new Exception('Invalid username');
        }

        /* Check if the password is valid. If not, throw an exception */
        if (!$this->isPasswdValid($passwd)) {
            throw new Exception('Invalid password');
        }

        /* Check if an account having the same name already exists. If it does, throw an exception */

        /* Finally, edit the account */

        /* Edit query template */
        $query = 'UPDATE utente SET nome=:name, cognome=:surname, username=:username,  pass=:passwd, Email=:Email, atttivazione = :enabled WHERE idUtente = :id';

        /* Password hash */
        $hash = password_hash($passwd, PASSWORD_DEFAULT);

        /* Int value for the $enabled variable (0 = false, 1 = true) */
        $intEnabled = $enabled ? 1 : 0;

        /* Values array for PDO */
        $values = array(':name' => $name, ':surname' => $surname, ':username' => $username, ':passwd' => $hash, ':Email' => $email,  ':enabled' => $intEnabled, ':id'=> $id);

        /* Execute the query */
        try {
            $res = $pdo->prepare($query);
            $res->execute($values);
        } catch (PDOException $e) {
            /* If there is a PDO exception, throw a standard exception */
            echo $e->getMessage();
            throw new Exception('Database query error 12');
        }
    }





    /* Delete an account (selected by its ID) */
    public function deleteAccount(int $id)
    {
        /* Global $pdo object */
        global $pdo;

        /* Check if the ID is valid */
        if (!$this->isIdValid($id)) {
            throw new Exception('Invalid account ID');
        }

        /* Query template */
        $query = 'DELETE FROM utente WHERE idUtente = :id';

        /* Values array for PDO */
        $values = array(':id' => $id);

        /* Execute the query */
        try {
            $res = $pdo->prepare($query);
            $res->execute($values);
        } catch (PDOException $e) {
            /* If there is a PDO exception, throw a standard exception */
            throw new Exception('Database query error');
        }

        /* Delete the Sessions related to the account */
        $query = 'DELETE FROM sessioneutente WHERE (idUtente = :id)';

        /* Values array for PDO */
        $values = array(':id' => $id);

        /* Execute the query */
        try {
            $res = $pdo->prepare($query);
            $res->execute($values);
        } catch (PDOException $e) {
            /* If there is a PDO exception, throw a standard exception */
            throw new Exception('Database query error');
        }
    }






    /* Saves the current Session ID with the account ID */
    private function registerLoginSession()
    {
        /* Global $pdo object */
        global $pdo;

        /* Check that a Session has been started */
        if (session_status() == PHP_SESSION_ACTIVE) {
            /* 	Use a REPLACE statement to:
			- insert a new row with the session id, if it doesn't exist, or...
			- update the row having the session id, if it does exist.
		*/
            $query = 'REPLACE INTO sessioneutente (idSessione, idUtente, login_time) VALUES (:sid, :idUtente, NOW())';
            $values = array(':sid' => session_id(), ':idUtente' => $this->id);

            /* Execute the query */
            try {
                $res = $pdo->prepare($query);
                $res->execute($values);
            } catch (PDOException $e) {
                /* If there is a PDO exception, throw a standard exception */
                echo $e->getMessage();
                throw new Exception('Database query error 2');
            }
        }
    }




    public function removeAvatar(int $idUser)
    {
        /* Global pdo */
        global $pdo;

        //controllo se esiste già un avatar per l'utente e in caso lo elimino
        // query di get avatar
        $query = 'SELECT ProPic FROM utente WHERE idUtente = :id';

        //array di valori 
        $values = array(':id' => $idUser);

        try {
            //preparo query
            $res = $pdo->prepare($query);

            //eseguo query con passaggio di valori
            $res->execute($values);
        } catch (PDOException $e) {
            throw new Exception('Database query error');
        }

        //fetch
        $res = $res->fetchColumn();

        //controllo se esiste vecchio avatar e lo elimino fisicamente e dal DB
        if ($res != NULL) {

            //elimino avatar se esiste immagine
            if (file_exists('../CaricareFILE/upload/' . $res)) {
                unlink('../CaricareFILE/upload/' . $res);
            }

            // query di annullamento avatar
            $query = 'UPDATE utente SET ProPic = NULL WHERE idUtente = :id';

            //array di valori 
            $values = array(':id' => $idUser);

            try {

                //preparo query
                $res = $pdo->prepare($query);

                //eseguo query con passaggio di valori
                $res->execute($values);
            } catch (PDOException $e) {
                throw new Exception('Database query error');
            }
        }
    }

    /* prende il file dell'avatar, fa l'upload e lo inserisce nel db a partire dall'Id utente */
    public function editAvatar(int $idUtente, $avatar)
    {
        //controllo back-end della validità del file di avatar
        if ($avatar['size'] > 0) {
            // Controllo che il file non superi i 5 MB
            if ($avatar['size'] > 5145728) {
                throw new Exception("L'avatar non deve superare i 5 MB");
            }

            // Ottengo le informazioni sull'immagine
            list($width, $height, $type, $attr) = getimagesize($avatar['tmp_name']);

            // Controllo che il file sia in uno dei formati GIF, JPG o PNG
            if (($type != 1) && ($type != 2) && ($type != 3)) {
                throw new Exception("L'avatar deve essere un'immagine GIF, JPG o PNG.");
            }
        }

        /* Global pdo */
        global $pdo;

        $this->removeAvatar($idUtente);


        //upload nuovo avatar
        //prendo l'estensione del nuovo file
        $ext = pathinfo($avatar['name'], PATHINFO_EXTENSION);

        //creo il nuovo nome del file
        $newName = $idUtente . "." . $ext;

        // sposto l'immagine nel percorso avatar
        move_uploaded_file($avatar['tmp_name'], "../CaricareFILE/upload/" . $newName);


        //procedo all'aggiornamento del DB
        // query di edit avatar
        $query = 'UPDATE utente SET ProPic = :avatar WHERE idUtente = :id';

        //array di valori 
        $values = array(':id' => $idUtente, ':avatar' => $newName);

        try {

            //preparo query
            $res = $pdo->prepare($query);

            //eseguo query con passaggio di valori
            $res->execute($values);
        } catch (PDOException $e) {
            throw new Exception('Database query error');
        }
    }













    /* Login with username and password */
    public function login(string $name, string $passwd): bool
    {
        /* Global $pdo object */
        global $pdo;

        /* Trim the strings to remove extra spaces */
        $name = trim($name);
        $passwd = trim($passwd);
        /* Check if the user name is valid. If not, return FALSE meaning the authentication failed */
        if (!$this->isNameValid($name)) {
            return FALSE;
        }

        /* Check if the password is valid. If not, return FALSE meaning the authentication failed */
        if (!$this->isPasswdValid($passwd)) {
            return FALSE;
        }

        /* Look for the account in the db. Note: the account must be enabled (account_enabled = 1) */
        $query = 'SELECT * FROM utente WHERE (username = :name) AND (atttivazione = 1)';

        /* Values array for PDO */
        $values = array(':name' => $name);
        /* Execute the query */
        try {
            $res = $pdo->prepare($query);
            $res->execute($values);
        } catch (PDOException $e) {
            /* If there is a PDO exception, throw a standard exception */

            throw new Exception('Database query error 1' . $e->getMessage());
        }

        $row = $res->fetch(PDO::FETCH_ASSOC);

        /* If there is a result, we must check if the password matches using password_verify() */
        if (is_array($row)) {
            if (password_verify($passwd, $row['pass'])) {
                /* Authentication succeeded. Set the class properties (id and name) */
                $this->id = intval($row['idUtente'], 10);
                $this->name = $name;
                $this->authenticated = TRUE;

                /* Register the current Sessions on the database */
                $this->registerLoginSession();

                /* Finally, Return TRUE */
                return TRUE;
            }
        }

        /* If we are here, it means the authentication failed: return FALSE */
        return FALSE;
    }






    /* Login using Sessions */
    public function sessionLogin(): bool
    {
        /* Global $pdo object */
        global $pdo;

        /* Check that the Session has been started */
        if (session_status() == PHP_SESSION_ACTIVE) {
            /* 
			Query template to look for the current session ID on the account_sessions table.
			The query also make sure the Session is not older than 7 days
		*/
            $query =

                'SELECT * FROM sessioneutente, utente WHERE (sessioneutente.idSessione = :sid) ' .
                'AND (sessioneutente.login_time >= (NOW() - INTERVAL 7 DAY)) AND (sessioneutente.idUtente =utente.idUtente) ' .
                'AND (utente.atttivazione = 1)';

            /* Values array for PDO */
            $values = array(':sid' => session_id());

            /* Execute the query */
            try {
                $res = $pdo->prepare($query);
                $res->execute($values);
            } catch (PDOException $e) {
                /* If there is a PDO exception, throw a standard exception */
                echo $e->getMessage();
                throw new Exception('Database query error 1');
            }

            $row = $res->fetch(PDO::FETCH_ASSOC);

            if (is_array($row)) {
                /* Authentication succeeded. Set the class properties (id and name) and return TRUE*/
                $this->id = intval($row['idUtente'], 10);
                $this->name = $row['nome'];
                $this->surname = $row['cognome'];
                $this->avatar = $row['ProPic'];
                $this->username = $row['username'];
                $this->email= $row['Email'];
                $this->intEnabled=$row ['atttivazione'];
                $this->authenticated = TRUE;

                return TRUE;
            }
        }

        /* If we are here, the authentication failed */
        return FALSE;
    }











    /* Logout the current user */
    public function logout()
    {
        /* Global $pdo object */
        global $pdo;

        /* If there is no logged in user, do nothing */
        if (is_null($this->id)) {
            return;
        }

        /* Reset the account-related properties */
        $this->id = NULL;
        $this->name = NULL;
        $this->authenticated = FALSE;

        /* If there is an open Session, remove it from the account_sessions table */
        if (session_status() == PHP_SESSION_ACTIVE) {
            /* Delete query */
            $query = 'DELETE FROM sessioneutente WHERE (idSessione = :sid)';

            /* Values array for PDO */
            $values = array(':sid' => session_id());

            /* Execute the query */
            try {
                $res = $pdo->prepare($query);
                $res->execute($values);
            } catch (PDOException $e) {
                /* If there is a PDO exception, throw a standard exception */
                throw new Exception('Database query error ');
            }
        }
    }




    /* "Getter" function for the $authenticated variable
    Returns TRUE if the remote user is authenticated */
    public function isAuthenticated(): bool
    {
        return $this->authenticated;
    }




    /* Close all account Sessions except for the current one (aka: "logout from other devices") */
    public function closeOtherSessions()
    {
        /* Global $pdo object */
        global $pdo;

        /* If there is no logged in user, do nothing */
        if (is_null($this->id)) {
            return;
        }

        /* Check that a Session has been started */
        if (session_status() == PHP_SESSION_ACTIVE) {
            /* Delete all account Sessions with session_id different from the current one */
            $query = 'DELETE FROM sessioneutente WHERE (idSessione != :sid) AND (idUtente = :idUtente)';

            /* Values array for PDO */
            $values = array(':sid' => session_id(), ':idUtente' => $this->id);

            /* Execute the query */
            try {
                $res = $pdo->prepare($query);
                $res->execute($values);
            } catch (PDOException $e) {
                /* If there is a PDO exception, throw a standard exception */
                throw new Exception('Database query error ');
            }
        }
    }
}
