<!DOCTYPE html>
<html>
    <head>
        <?php 
            require 'js/config.php';
            require 'css/css.php';
        ?>
    </head>
    <body>
        <?php
            require('config.php');
            if (isset($_REQUEST['login'], $_REQUEST['password'])){
                // récupérer l'email et supprimer les antislashes ajoutés par le formulaire
                $login = stripslashes($_REQUEST['login']);
                $login = mysqli_real_escape_string($conn, $login);
                // récupérer le mot de passe et supprimer les antislashes ajoutés par le formulaire
                $password = stripslashes($_REQUEST['password']);
                $password = mysqli_real_escape_string($conn, $password);
                //requéte SQL + mot de passe crypté
                    $query = "INSERT into `users` (login, password)
                            VALUES ('$login', '".hash('sha256', $password)."')";
                // Exécuter la requête sur la base de données
                    $res = mysqli_query($conn, $query);
                    if($res){
                        echo 
                        "<div class='sucess'>
                            <h3>Vous êtes inscrit avec succès.</h3>
                            <p>Cliquez ici pour vous <a href='login.php'>connecter</a></p>
                        </div>";
                    }
                } else {
                ?>
                <form action="" method="post">
                    <h1>S'inscrire</h1>
                    <input type="text" class="form-control" name="login" placeholder="Email" required />
                    <input type="password" class="form-control" name="password" placeholder="Mot de passe" required />
                    <input class="mt-4 btn btn-primary" type="submit" name="submit" value="S'inscrire" class="btn btn-primary" />
                    <p>Déjà inscrit? <a href="login.php">Connectez-vous ici</a></p>
                </form>
        <?php } ?>
    </body>
</html>