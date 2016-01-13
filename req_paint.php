<?php session_start();

if (!isset($_SESSION['user'])) {
    header("Location: main.php");
}

$commands = stripslashes($_POST['commands']);
$picture = stripslashes($_POST['picture']);
$nom_dessin = stripslashes($_POST['nom_dessin']);

try {
    $dbh = new PDO('mysql:host=localhost;dbname=pictionnary', 'test', 'test');
    $sql = $dbh->prepare("INSERT INTO draws (id_user, commandes, dessin, nom_dessin) VALUES (:id_user, :commandes, :dessin, :nom_dessin)");
    $sql->bindValue(":id_user" , $_SESSION['user']['id']);
    $sql->bindValue(":commandes" , $commands);
    $sql->bindValue(":dessin"  , $picture);
    $sql->bindValue(":nom_dessin" , $nom_dessin);

    if (!$sql->execute()) {
        echo "PDO::errorInfo():<br/>";
        $err = $sql->errorInfo();
        print_r($err);
    } else {
        header("Location: main.php");
    }

    $dbh = null;
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    $dbh = null;
    die();
}