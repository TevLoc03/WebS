<?php session_start();
if(isset($_SESSION['user'])){ header('location: main.php'); exit();
} else { ?>
<!DOCTYPE html>  
<html>  
    <head>  
        <meta charset=utf-8 />  
        <title>Pictionnary - Connexion</title>  
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
			.col-md-offset-3.col-md-6{
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
            <div class="col-md-offset-3 col-md-6" >

                <h2 class="text-center">Connectez-vous</h2> 

                <?php 
                if(!empty($_GET['erreur'])){ ?>
                    <div class="alert alert-danger" role="alert">
                        <span class="required_notification"><?php echo $_GET['erreur'] ?></span>
                    </div> 
                <?php } ?>
                
                <div class="alert alert-info" role="alert">
                    <span class="required_notification">Pas encore inscrit ?<b>
                        <a href="inscription.php"> Inscription</a></b></span>
                </div>

                <form class="connexion" action="req_login.php" method="post" name="connexion">  
                       
                    <div class="form-group">
                        <label for="email">Login</label>
                        <input type="email" class="form-control" id="email" name="email" autofocus placeholder="exemple@mail.fr" required/>
                    </div>  
                       
                    <div class="form-group">
                        <label for="password">Mot de passe * </label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" pattern="[a-zA-Z0-9]{4,8}" required/>
                        <span class="form_hint">De 6 à 8 caractères alphanumériques.</span>
                    </div>
                    
                     <div class="col-md-offset-4 col-md-3">
                         <button type="submit" class="btn btn-lg btn-success">Connexion</button>
                     </div>
                </form> 
            </div> 

        </div>
        <script src="js/function.js"></script>
    </body>  
</html>  
<?php } ?>