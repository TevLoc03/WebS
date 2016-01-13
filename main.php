<?php 
    session_start();
if(isset($_SESSION['user'])){

?>
<!DOCTYPE html>  
<html>  
<head>  
    <meta charset=utf-8 />  
    <title>Pictionnary - Accueil</title>  
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <style type="text/css">
    	body.design{
            background-image: url('img/bg.jpeg');
                background-size: cover;
                background-position: center;
        	}
			.col-xs-offset-2.col-xs-8{
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
        #profil{
            border-bottom: 3px solid #<?php echo $_SESSION['user']['couleur']; ?>!important;
            margin-bottom: 10px;  
        }
        #profil h2{
            margin-top: 0px;
            text-align: center;
        }
		#img_profil{
			border: 9px solid black;
    		border-radius: 60%;
	}
    </style>
</head>  
<body class="design">

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Pictionnary</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Accueil</a></li>
            <li><a href="req_logout.php">Deconnexion</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container" style="margin-top:100px;">
		<div class="row">
            <div class="col-xs-offset-2 col-xs-8">
                	<div class="col-xs-12" id="profil"><h2>Profil</h2></div>
                    
                	<div class="col-xs-12 text-center">
                		<img id="img_profil" src=<?= !empty($_SESSION['user']['profilepic'])? $_SESSION['user']['profilepic']: 'img/profil.png'; ?> width="180" heigh="180" />
                	</div>
                	<div class="col-xs-12">
                        <h2 class="text-center"><?php echo $_SESSION['user']['prenom']; ?></h2>
                        <?php if(!empty($_SESSION['user']['nom'])){  ?><h2 class="text-center"><?php echo $_SESSION['user']['nom']; ?></h2><?php } ?>
                    	<h2 class="text-center"><?php echo $_SESSION['user']['email']; ?></h2>	
                    </div>
                    <div class="col-xs-12">
                        <a href="paint.php" id="btn-commencer-dessin" class="btn btn-lg btn-success">Commencer un dessin</a>
                    </div>
            </div>
          </div>
      </div>
          <div class="container">  
          	<div class="row">
            
          
                <?php
                    try {
                        $dbh = new PDO('mysql:host=localhost;dbname=pictionnary', 'test', 'test');
                        $sql = $dbh->query("SELECT id,nom_dessin FROM draws WHERE id_user = " . $_SESSION['user']['id']);

                        if ($sql->rowCount() >= 1) {
                            echo '<div class="col-xs-offset-2 col-xs-8">'
								.'<div class="col-xs-12" id="profil"><h2>Mes dessins</h2></div>'
                                .'<div class="panel panel-default col-xs-12">'
								.'<div class="table-responsive">'
                                . '<table class="table ">'
								.'<tr>'
                                .'<td >N*</td>'
								.'<td >Nom</td>'
								.'<td >Voir</td>'
								.'<td >Supprimer</td>'
								.'<tr>';

                            foreach ($sql as $row) { 
                                echo '<tr>'
                                    .'<td >'.$row['id'].'</td>'
                                    .'<td >'.$row['nom_dessin'].'</td>'
                                    .'<td >'
                                        .'<a class="btn btn-primary" href="guess.php?id='.$row['id'].'"><i class="glyphicon glyphicon-eye-open"></i></a>'
                                    .'</td>'
                                    .'<td >'
                                        .'<form method="post" action="delete_dessin.php">'
                                            .'<button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>'
                                             .'<input type="hidden" name="id_delete" value="'.$row['id'].'" />'
                                        .'</form>'
                                    .'</td>'
                                    
                                    .'</tr>';
                                }

                                echo '</table>'
                                    . '</div></div></div>';
                            }

                            $dbh = null;
                        } catch (PDOException $e) {
                            print "Erreur !: " . $e->getMessage() . "<br/>";
                            $dbh = null;
                            die();
                        }
                    ?> 
                    </div>      
                </div>

    </div>
</body>
</html>
<?php } else {
    header('location: connexion.php');
} ?>