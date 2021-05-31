<?php

require_once('include.php');

class Elemento
{

    // setto i vari cpmponenti della classe elemento
    private $idElemento;

    private $titolo;

    private $trama;

    private $copertina;

    private $Stato;

    public function __construct()
    {
        $this->idElemento = NULL;
        $this->titolo = NULL;
        $this->trama = NULL;
        $this->copertina = NULL;
        $this->Stato = 0;
    }

    public function __destruct()
    {
    }



    // stetto get di ogni lemento 
    public  function getId()
    {
        return $this->idElemento;
    }
    public  function getTitolo()
    {
        return $this->titolo;
    }
    public  function geTrama()
    {
        return $this->trama;
    }
    public  function getCopertina()
    {
        return $this->copertina;
    }
    public function getStato()
    {
        return $this->Stato;
    }

    // controllo validirà id
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




    //   controllo valità del nTitolo
    public function isTitoloValid(string $name): bool
    {
        /* Initialize the return variable */
        $valid = TRUE;

        /* Example check: the length must be between 2 and 70 chars */
        $len = mb_strlen($name);

        if (($len < 2) || ($len > 200)) {
            $valid = FALSE;
        }

        $whiteList = 'ABCDEFGHILMNOPQRSTUVZJKWYabcdefghijklmnopqrstuvwxyz1234567890. @!?,:-_<>ìéàùò+*|\\ \' \"';

        for ($i = 0; $i < mb_strlen($name); $i++) {
            $char = mb_substr($name, $i, 1);

            if (mb_strpos($whiteList, $char) === FALSE) {
                $valid = FALSE;
            }
        }

        /* You can add more checks here */

        return $valid;
    }










    // ottenre id avendo nome della serie
    public function getIdFromTitolo(string $name): ?int
    {
        /* Global $pdo object */
        global $pdo;

        /* Since this method is public, we check $name again here */
        if (!$this->isTitoloValid($name)) {
            throw new Exception('Invalid user name');
        }

        /* Initialize the return value. If no account is found, return NULL */
        $id = NULL;

        /* Search the ID on the database */
        $query = 'SELECT idElemento FROM mywatchlist.elemento WHERE (titolo = :name)';
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
            $id = intval($row['idElemento'], 10);
        }

        return $id;
    }










    // aggiunta nuovo elemento a db tramite funzione 
    public function AdElemento(string $Tit, string $Tram, $cop,  $isEnd, $nomeau, $cognomeau, $nazione, $nascita, $categoria, $genere,$ep,$stag)
    {

        global $pdo;

        if (!$this->isTitoloValid($Tit)) {
            throw new Exception('Invalid Title');
        }


        /* Check if an account having the same name already exists. If it does, throw an exception */
        if (!is_null($this->getIdFromTitolo($Tit))) {
            throw new Exception('Titolo già presente');
        }

        /* Finally, add the new element */
        /* Insert query template */
        $idAutore = $this->InsAutore($nomeau, $cognomeau, $nazione, $nascita);
        $idCategoria = $this->AdCategoria($categoria);
        $query = 'INSERT INTO mywatchlist.elemento (titolo, trama, isFinito,idAutore,idCategoria) VALUES (:titolo, :trama, :isEnd,:idAutore,:idCategoria)';
        /* Values array for PDO */
        $values = array(':titolo' => $Tit, ':trama' => $Tram, ':isEnd' => $isEnd, 'idAutore' => $idAutore, 'idCategoria' => $idCategoria);

        /* Execute the query */
        try {
            $res = $pdo->prepare($query);

            $res->execute($values);
        } catch (PDOException $e) {
            echo $e->getMessage();
            /* If there is a PDO exception, throw a standard exception */
            throw new Exception('Database query error !!!!!!!!!!!!!');
        }

        $idElemento = $this->getIdFromTitolo($Tit);
        $this->editCopertina($idElemento, $cop);
        $this->AdGenere($idElemento, $genere);
        $this->AdStagione($ep,$stag,$idElemento);

        $query = 'UPDATE mywatchlist.elemento SET idgenere =:idgenere WHERE idElemento= :id';
        /* Values array for PDO */
        $values = array('idgenere' => $idElemento, 'id' => $idElemento);

        /* Execute the query */
        try {
            $res = $pdo->prepare($query);

            $res->execute($values);
        } catch (PDOException $e) {
            echo $e->getMessage();
            /* If there is a PDO exception, throw a standard exception */
            throw new Exception('Database query error ??????');
        }

        /* Return the new ID */
        return $pdo->lastInsertId();
    }







    // rimuovo copetina esistete
    public function removeCopertina(int $idElem)
    {
        /* Global pdo */
        global $pdo;

        //controllo se esiste già un avatar per l'utente e in caso lo elimino
        // query di get avatar
        $query = 'SELECT Copertina FROM elemento WHERE idElemento = :id';

        //array di valori 
        $values = array(':id' => $idElem);

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
            if (file_exists('../CaricareFILE/Cop/' . $res)) {
                unlink('../CaricareFILE/Cop/' . $res);
            }

            // query di annullamento avatar
            $query = 'UPDATE elemento SET Copertina = NULL WHERE idElemento = :id';

            //array di valori 
            $values = array(':id' => $idElem);

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








    // aggiorno immagine copertina serie

    public function editCopertina(int $idElem, $Cop)
    {
        if ($Cop['size'] == 0) {
            $this->removeCopertina($idElem);
        } else {
            //controllo back-end della validità del file di avatar
            if ($Cop['size'] > 0) {
                // Controllo che il file non superi i 5 MB
                if ($Cop['size'] > 5145728) {
                    throw new Exception("L'avatar non deve superare i 5 MB");
                }

                // Ottengo le informazioni sull'immagine
                list($width, $height, $type, $attr) = getimagesize($Cop['tmp_name']);

                // Controllo che il file sia in uno dei formati GIF, JPG o PNG
                if (($type != 1) && ($type != 2) && ($type != 3)) {
                    throw new Exception("L'avatar deve essere un'immagine GIF, JPG o PNG.");
                }
            }


            /* Global pdo */
            global $pdo;

            $this->removeCopertina($idElem);


            //upload nuovo avatar
            //prendo l'estensione del nuovo file
            $ext = pathinfo($Cop['name'], PATHINFO_EXTENSION);

            //creo il nuovo nome del file
            $newName = $idElem . "." . $ext;

            // sposto l'immagine nel percorso avatar
            move_uploaded_file($Cop['tmp_name'], "../CaricareFILE/Cop/" . $newName);


            //procedo all'aggiornamento del DB
            // query di edit avatar
            $query = 'UPDATE elemento SET Copertina = :avatar WHERE idElemento = :id';

            //array di valori 
            $values = array(':id' => $idElem, ':avatar' => $newName);

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



    public function InfoCatch(string $Titol): bool
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

                'SELECT * FROM elemento WHERE (idElemento :sid) ';

            /* Values array for PDO */
            $values = array(':sid' => $this->getIdFromTitolo($Titol));

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
                $this->idElemento = intval($row['idElemento'], 10);
                $this->titolo = $row['titolo'];
                $this->trama = $row['trama'];
                $this->copertina = $row['Copertina'];
                $this->Stato = $row['isFinito'];
                return TRUE;
            }
        }

        /* If we are here, the authentication failed */
        return FALSE;
    }


    public function InsAutore(string $NomeAu, string $CognomeAu, string $Nazione, $nascita)
    {
        global $pdo;

        if (!$this->isTitoloValid($NomeAu)) {
            throw new Exception('Nome Non Valido ');
        }
        if (!$this->isTitoloValid($CognomeAu)) {
            throw new Exception('Cognome non Valido');
        }
        /* Insert query template */
        $query = 'INSERT INTO mywatchlist.autore (nome, cognome,DataNascita,nazione ) VALUES (:nome, :cognome, :DataNAscita,:nazione)';
        /* Values array for PDO */
        $values = array(':nome' => $NomeAu, ':cognome' => $CognomeAu, ':DataNAscita' => $nascita, ':nazione' => $Nazione);

        /* Execute the query */
        try {
            $res = $pdo->prepare($query);

            $res->execute($values);
        } catch (PDOException $e) {
            echo $e->getMessage();
            /* If there is a PDO exception, throw a standard exception */
            throw new Exception('Database query error autore');
        }
        return $pdo->lastInsertId();

        $query = 'SELECT idAutore FROM mywatchlist.autore WHERE nome=:nome AND cognome=:cognome AND DataNascita=:DataNascita AND nazione=:nazione';
        $values = array(':nome' => $NomeAu, ':cognome' => $CognomeAu, ':DataNAscita' => $nascita, ':nazione' => $Nazione);
        /* Execute the query */
        try {
            $res = $pdo->prepare($query);

            $res->execute($values);
        } catch (PDOException $e) {
            echo $e->getMessage();
            /* If there is a PDO exception, throw a standard exception */
            throw new Exception('Database query error getIdAutore');
        }
        $row = $res->fetch();
        return $row['idAutore'];
    }


    public function AdCategoria(string $categoria)
    {
        global $pdo;
        $query = 'SELECT idCategoria FROM mywatchlist.categoria WHERE nome=:nome';
        $values = array(':nome' => $categoria);
        /* Execute the query */
        try {
            $res = $pdo->prepare($query);

            $res->execute($values);
        } catch (PDOException $e) {
            echo $e->getMessage();
            /* If there is a PDO exception, throw a standard exception */
            throw new Exception('Database query error getCategoria');
        }
        $row = $res->fetch();
        return $row['idCategoria'];
    }

    public function AdGenere(int $idGenere, $genere)
    {
        global $pdo;
        $query = 'INSERT INTO mywatchlist.genere (idGenere, nome) VALUES (:idGenere, :nome)';
        /* Values array for PDO */
        $values = array(':idGenere' => $idGenere,  ':nome' => $genere);

        /* Execute the query */
        try {
            $res = $pdo->prepare($query);

            $res->execute($values);
        } catch (PDOException $e) {
            echo $e->getMessage();
            /* If there is a PDO exception, throw a standard exception */
            throw new Exception('Database query error set genere');
        }
    }

    public function AdStagione($episodi, $stagione, $idElemento)
    {
        global $pdo;
        $query = 'INSERT INTO mywatchlist.stagione (idElemento, NEpisodi,NStagione) VALUES (:id, :ep,:stag)';
        /* Values array for PDO */
        $values = array(':id' => $idElemento,  ':ep' => $episodi,':stag'=>$stagione);

        /* Execute the query */
        try {
            $res = $pdo->prepare($query);

            $res->execute($values);
        } catch (PDOException $e) {
            echo $e->getMessage();
            /* If there is a PDO exception, throw a standard exception */
            throw new Exception('Database query error set stagione');
        }
    }
    public function SetId($id){
        $this->idElemento=$id;
    }
}
