<?php

function creationdb(){
    $link = mysqli_connect("localhost", "root", "");
    // Verification de la connexion
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    $sql = "CREATE DATABASE testwimova";
    if(mysqli_query($link, $sql)){
        echo "Database created successfully";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
    mysqli_close($link);

}

// cette fonction vous connecte à la base de données et retourne
// un objet grâce auquel on peut effectuer des requêtes SQL
function connexionbd() {

    // A MODIFIER : spécifiez votre login et votre mot de passe ici !
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = 'testwimova';

    // chaîne de connexion pour PDO (ne pas modifier)
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

    // connexion au serveur de bases de données
    $bd = new PDO($dsn, $username, $password);

    return $bd;
}

// cette fonction effectue une requête SQL. On doit lui fournir
// l'objet base de données et la requête
function requete($bd, $req) {

    // appel de la méthode query() sur l'objet base de données :
    // la requête est traitée par le serveur et retourne un pointeur de resultat
    $resultat = $bd->query($req);

    // on demande à ce pointeur d'aller chercher toutes les données de résultat
    // d'un coup - on obtient un tableau de tableaux associatifs (un par ligne de la table)
    // Note : dans le cas d'une insertion, on ne récupère pas le resultat
    if ($resultat) {
        $tableau = $resultat->fetchAll(PDO::FETCH_ASSOC);
        // on retourne ce tableau
        return $tableau;
    }
}

// cree la table qui stockera les users
// NB: à appeler une seule fois !
function creation_table() {
    $maBd = connexionbd();
    $maRequeteCreation = "CREATE TABLE users (id int AUTO_INCREMENT PRIMARY KEY, first_name varchar(100), last_name varchar(100), email varchar(40), image varchar (40), date_ajout timestamp DEFAULT CURRENT_TIMESTAMP) CHARACTER SET UTF8";
    requete($maBd, $maRequeteCreation);
}

// insère des données d'exemple dans la base
// NB: à appeler une seule fois !
function insertion_exemples() {
    $maBd = connexionbd();
    $maRequeteInsertion = "INSERT INTO users VALUES "
        . "(DEFAULT, 'Elon', 'Musk','elon.musk@gmail.com','elon.png', DEFAULT),"
        . "(DEFAULT, 'Hichem', 'Koched','hichem.koched@gmail.com','moi.png', DEFAULT),"
        . "(DEFAULT, 'Lionel', 'Messi','lionel.messi@gmail.com','messi.png', DEFAULT),"
        . "(DEFAULT, 'Ngolo', 'Kante','ngolo.kante@gmail.com','kante', DEFAULT),"
        . "(DEFAULT, 'Marion', 'Cotillard','marion.cotillard@gmail.com','marion.png', DEFAULT),"
        . "(DEFAULT, 'Omar', 'Sy','omar.sy@gmail.com','omar.png', DEFAULT)"
    ;
    requete($maBd, $maRequeteInsertion);
}

// vide la table de toutes ses donnees
// NB: appeler uniquement si besoin de faire le ménage
function vidage_table() {
    $maBd = connexionbd();
    $maRequeteVidage = "TRUNCATE TABLE users";
    requete($maBd, $maRequeteVidage);
}
