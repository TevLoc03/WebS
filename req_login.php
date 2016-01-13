<?php 

    $email = stripslashes($_POST['email']);  
    $password = stripslashes($_POST['password']);

    try {  
        // Connect to server and select database.  
        $dbh = new PDO('mysql:host=localhost;dbname=pictionnary', 'test', 'test');  
        
        // Vérifier si un utilisateur avec cette adresse email existe dans la table.   
        $sql = $dbh->query('SELECT * FROM users WHERE email = "'.$email.'" AND password = "'.hash('sha256', $password).'" ');
        
        if ($sql->rowCount() == 1) { 

            session_start();
            $_SESSION['user'] = $sql->fetchAll(PDO::FETCH_ASSOC)[0];
            header("Location: main.php"); 

        } else {

        	header("location:connexion.php?erreur=".urlencode('Mot de passe ou email invalide!'));
            
        }
    } catch (PDOException $e) {  
        print "Erreur !: " . $e->getMessage() . "<br/>";  
        $dbh = null;  
        die();  
    }  
?>