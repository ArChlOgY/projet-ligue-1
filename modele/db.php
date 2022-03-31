<?php

$dbh = 'mysql:host=localhost;dbname=ligue1';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO($dbh, $user, $pass);
    #print 'Bravo la db est connectée !';
} catch (PDOException $e) {
    print "Erreur: " . $e->getMessage();
    die();
}

?>