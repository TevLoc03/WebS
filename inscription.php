<?php session_start(); if(isset($_SESSION['user'])){ header('Location: main.php'); }?>
<!DOCTYPE html>  
<html>  
    <head>  
        <meta charset=utf-8 />  
        <title>Pictionnary - Inscription</title>  
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <style type="text/css">
           body.design{
        		background: #EEEBDA url('img/bg.png');
                background-size: cover;
                background-position: center;
        	}
			.col-md-offset-2.col-md-8{
				background:white!important;
				margin-top:69px!important;
				padding-left:33px!important; 
				padding-right:33px!important; 
				padding-bottom:33px!important; 
				padding-top:10px!important; 
				border-radius: 9px!important;
			}
			.text-center{
				border-bottom: rgb(144, 140, 140) 1px solid;
    			padding-bottom: 10px;
			}
        </style>
    </head>  
    <body class="design"> 
        <div class="container">
			<div class="col-md-offset-4 col-md-4" >
            	<img src="img/logo_pictionnary.png" width="100%"/>
            </div>
            
            <div class="col-md-offset-2 col-md-8" >
            <h2 class="text-center" >Inscrivez-vous</h2>  
            <form class="inscription" action="req_inscription.php" method="post" name="inscription">

                <div class="alert alert-info" role="alert">
                    <span class="required_notification">Connexion ?<b><a href="connexion.php"> Connexion</a></b></span>
                </div>

                <div class="alert alert-warning" role="alert">
                    <span class="required_notification">Les champs obligatoires sont indiqués par *</span>
                </div>

                <?php 
                if(!empty($_GET['erreur'])){ ?>
                    <div class="alert alert-danger" role="alert">
                        <span class="required_notification"><?php echo $_GET['erreur'] ?></span>
                    </div> 
                <?php } ?>
               
                <div class="form-group">
                    <label for="email">Email *</label>
                        <input type="email" class="form-control" id="email" name="email" autofocus placeholder="exemple@mail.fr" required>
                    </div>  
                    
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" value='<?php  if(!empty($_GET['nom'])) { echo htmlspecialchars($_GET['nom']); } ?>'class="form-control" id="nom" name="nom" placeholder="Nom" />
                    </div>

                    <div class="form-group">
                        <label for="prenom">Prénom *</label>
                        <input type="text" value="<?php  if(!empty($_GET['prenom'])) { echo htmlspecialchars($_GET["prenom"]); }?>"class="form-control" id="prenom" name="prenom" placeholder="Prénom" required />
                    </div>

                    <div class="form-group">
                        <label for="tel">Téléphone</label>
                        <input type="tel" value="<?php if(!empty($_GET['tel'])) { echo htmlspecialchars($_GET['tel']); } ?>"class="form-control" id="tel" name="tel" placeholder="0622155669" pattern="[0-9]{10}" />
                    </div>

                    <div class="form-group">
                        <label for="sw">Site Web</label>
                        <input type="url" value="<?php if(!empty($_GET['sw'])) { echo htmlspecialchars($_GET['sw']); } ?>" class="form-control" id="sw" name="sw" placeholder="www.monsite.com" />
                    </div>

                    <label for="sexe">Sexe</label>
                    <div class="radio">
                        <label><input type="radio" name="sexe" id="radios1" value="H" <?php if(!empty($_GET['sexe']) && $_GET['sexe'] == "H"){ echo 'checked'; } ?> /> Homme </label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="sexe" id="radios1" value="F" <?php if(!empty($_GET['sexe']) && $_GET['sexe'] == "F"){ echo 'checked'; } ?> /> Femme </label>
                    </div>

                    <div class="form-group">
                        <label for="date">Date naissance *</label>
                        <input type="date" value="<?php if(!empty($_GET['anniv'])) { echo htmlspecialchars($_GET['anniv']); } ?>" min="01/01/1900" class="form-control" id="date" name="anniv" placeholder="DD/MM/YYYY" onchange="calculAge()" required />
                    </div>

                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" class="form-control" id="age" name="age" placeholder="Age calculé en fonction de la date de naissance" disabled />
                    </div>

                    <div class="form-group">
                        <label for="ville">Ville</label>
                        <input type="text" value="<?php if(!empty($_GET['ville'])) { echo htmlspecialchars($_GET['ville']); } ?>" class="form-control" id="ville" name="ville" placeholder="Nice" />
                    </div>

                    <div class="form-group">
                        <label for="taille">Taille <span id="taille">1</span>m</label>
                        <input type="range" value="<?php if(!empty($_GET['taille'])) { echo htmlspecialchars($_GET['taille']); } ?>" class="" name="taille" id="taille" min="0" step="0.01" value="1" max="2.5" oninput="document.getElementById('taille').textContent=value" />
                    </div>

                    <div class="form-group">
                        <label for="couleurp">Couleur préféré </label>
                        <input type="color" value="<?php if(!empty($_GET['couleur'])) { echo htmlspecialchars($_GET['couleur']); } ?>" class="form-control" name="couleur" id="couleurp" value="#000" />
                    </div>

                    <div class="form-group">
                        <label for="profil">Photo de profil </label>
                        <input style="color: white;" type="file" id="profil" onchange="loadProfilePic(this)" />
                        <input type="hidden" name="photo" id="photo"/> 
                        <canvas id="preview" width="96" height="96"></canvas>   
                    </div>

                    <div class="form-group">
                        <label for="password">Mot de passe * </label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" pattern="[a-zA-Z0-9]{4,8}" required />
                        <span class="form_hint">De 6 à 8 caractères alphanumériques.</span>
                    </div>

                    <div class="form-group">
                        <label for="confirmpassword">Confirmez Mot de passe *</label>
                        <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" onkeyup="verifP(this)" placeholder="Confirmez Mot de passe" required />
                        <span class="form_hint">Les mots de passes doivent être égaux.</span>
                    </div>  
					<div class="col-md-offset-4 col-md-3">
                    	<button type="submit" class="btn btn-lg btn-default">Soumettre Formulaire</button>
					</div>
                        <br />
                        <br />

            </form> 
        </div> 
        <div class="col-md-2">
        </div>
        </div>
        <div class="container">
            <br />
            <br />
        </div>
        <script src="js/function.js"></script>
    </body>  
</html>  