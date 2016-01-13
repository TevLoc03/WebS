<?php  
    
    // on recupere les posts et on les stocks dans des variables
    $email = stripslashes($_POST['email']);  
    $password = stripslashes($_POST['password']);  
    $nom = stripslashes($_POST['nom']);  
    $prenom = stripslashes($_POST['prenom']);  
    $tel = stripslashes($_POST['tel']);  
    $website = stripslashes($_POST['sw']);  
    $sexe =  empty($_POST['sexe']) ? null : stripslashes($_POST['sexe']);   
    $birthdate = stripslashes($_POST['anniv']);  
    $ville = stripslashes($_POST['ville']);  
    $taille = stripslashes($_POST['taille']);  
    $couleur = stripslashes($_POST['couleur']);  
    $profilepic = stripslashes($_POST['photo']);  

    try {  

        // Connect to server and select database.  
        $dbh = new PDO('mysql:host=localhost;dbname=pictionnary', 'test', 'test');  
        
        // Vérifier si un utilisateur avec cette adresse email existe dans la table.   
        $sql = $dbh->query('SELECT email FROM users WHERE email = "'.$email.'"');

        if ($sql->rowCount() == 1) {  

            header("Location: inscription.php?"
                ."nom=".urlencode($nom)."&prenom=".urlencode($prenom)."&tel=".urlencode($tel)
                ."&sw=".urlencode($sw)."&sexe=".urlencode($sexe)."&anniv=".urlencode($birthdate)
                ."&ville=".urlencode($ville)."&taille=".urlencode($taille)."&couleur=".urlencode($couleur)
                ."&erreur=".urlencode("Adresse mail déja utilisé"));

        }  
        else {  

            // Tenter d'inscrire l'utilisateur dans la base  
            $sql = $dbh->prepare("INSERT INTO users (email, password, nom, prenom, tel, website, sexe, birthdate, ville, taille, couleur, profilepic) "  
                                ."VALUES (:email, :password, :nom, :prenom, :tel, :website, :sexe, :birthdate, :ville, :taille, :couleur, :profilepic)");

            $sql->bindValue(":email", $email);
            $sql->bindValue(":nom", empty($nom)?null:$nom, PDO::PARAM_STR);  
            $sql->bindValue(":prenom", empty($prenom)?null:$prenom, PDO::PARAM_STR) ;
            $sql->bindValue(":tel", empty($tel)?null:$tel, PDO::PARAM_INT);
            $sql->bindValue(":website", empty($website)?null:$website, PDO::PARAM_STR);
            $sql->bindValue(":sexe", empty($sexe)?null:$sexe, PDO::PARAM_STR);
            $sql->bindValue(":birthdate", empty($birthdate)?null: $birthdate , PDO::PARAM_STR);
            $sql->bindValue(":ville", empty($ville)?null:$ville, PDO::PARAM_STR);
            $sql->bindValue(":taille", empty($taille)?null:$taille, PDO::PARAM_INT);
            $sql->bindValue(":couleur", empty($couleur)?null:str_replace('#', '', $couleur), PDO::PARAM_STR);
            $sql->bindValue(":profilepic", empty($profilepic)?null:$profilepic, PDO::PARAM_LOB);
            $sql->bindValue(":password", hash('sha256', $password));

            // on tente d'exécuter la requête SQL, si la méthode renvoie faux alors une erreur a été rencontrée.  
            if (!$sql->execute()) {  

                echo "PDO::errorInfo():<br/>";  
                $err = $sql->errorInfo();  
                print_r($err);  

            } else {  
      
                // ici démarrer une session  
                session_start();

                // ensuite on requête à nouveau la base pour l'utilisateur qui vient d'être inscrit   
                $sql = $dbh->query("SELECT u.id, u.email, u.nom, u.prenom, u.couleur, u.profilepic FROM USERS u WHERE u.email='".$email."'");  
                
                if ($sql->rowCount()<1) {  
                    header("Location: inscription.php?erreur=".urlencode("un problème est survenu"));  
                }  
                else {  

                    // on récupère la ligne qui nous intéresse et on la stock dans une Session   
                    $_SESSION['user'] = $sql->fetchAll(PDO::FETCH_ASSOC)[0];
                   
                // ici,  rediriger vers la page main.php
                header("Location: main.php"); 
                } 
            }  
            $dbh = null;  
        }

    } catch (PDOException $e) {  
        print "Erreur !: " . $e->getMessage() . "<br/>";  
        $dbh = null;  
        die();  
    }  
?>  