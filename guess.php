<?php session_start();

if (!isset($_SESSION['user'])) {
    header("Location: main.php");
} else {
    if (!isset($_GET['id']) || !empty($_GET['id'])) {
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=pictionnary', 'test', 'test');
            $sql = $dbh->query("SELECT commandes FROM draws WHERE id = " . stripslashes($_GET['id']));

            if ($sql->rowCount() > 0) {
                $commands = $sql->fetchAll()[0]['commandes'];
?>
<!DOCTYPE html>
  <html>
    <head>
       <meta charset="utf-8"/>
       <title>Pictionnary</title>
       <!-- Latest compiled and minified CSS -->
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
       <!-- Latest compiled and minified JavaScript -->
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    	<script type="text/javascript">
                        var size, color;
                        var commands = <?= $commands ?>;

                        window.onload = function() {
                            var canvas    = document.getElementById('myCanvas2');
                            canvas.width  = 300;
                            canvas.height = 400;
                            var context   = canvas.getContext('2d');

                            canvas.style.marginLeft = ((window.innerWidth - canvas.width) / 2) + "px";

                            window.onresize = function() {
                                canvas.style.marginLeft = ((window.innerWidth - canvas.width) / 2) + "px";
                            };

                            var draw = function(c) {
                                context.beginPath();
                                context.fillStyle = c.color;
                                context.arc(c.x, c.y, c.size, 0, 2 * Math.PI);
                                context.fill();
                                context.closePath();
                            };

                            var clear = function() {
                                context.clearRect(0, 0, canvas.width, canvas.height);
                            };

                            var i = 0;
                            var iterate = function() {
                                if (i >= commands.length) { return; }

                            var c = commands[i];

                            switch (c.command) {
                               case "draw":
                                  draw(c);
                                   break;
                               case "clear":
                                   clear();
                                   break;
                                default:
                                  console.error("cette commande n'existe pas "+ c.command);
                                }

                                i++;
                                setTimeout(iterate,30);
                            };

                            iterate();
                        };
		 </script>
	</head>
    <body>
     <canvas id="myCanvas2"></canvas>
        <a id="btn-retour-guess" class="btn btn-danger" href="main.php">Retour</a>
    </body>
</html>

<?php } else { header("Location: main.php"); }
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            $dbh = null;
            die();
        } } else {
        header("Location: main.php");
    }
}
?>