<?php 

    $id_delete = $_POST['id_delete'];

    try {
        $dbh = new PDO('mysql:host=localhost;dbname=pictionnary', 'test', 'test');
        $sql = $dbh->prepare("DELETE FROM draws WHERE id=".$id_delete);


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
?>