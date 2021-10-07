<!DOCTYPE html>
<html>
    <head>
        <?php 
            require 'js/config.php';
            require 'css/css.php';
        ?>
    </head>
    <body>
        <div class="container p-4">
            <?php
                require('config.php');
                session_start();

                if (isset($_POST['login'])){
                    $login = stripslashes($_REQUEST['login']);
                    $login = mysqli_real_escape_string($conn, $login);
                    $password = stripslashes($_REQUEST['password']);
                    $password = mysqli_real_escape_string($conn, $password);
                        $query = "SELECT * FROM `users` WHERE login='$login' and password='".hash('sha256', $password)."'";
                    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
                    $rows = mysqli_num_rows($result);

                    if($rows==1){
                        $_SESSION['login'] = $login;
                        header("Location: accueil.php");
                    } else {
                        $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
                    }
                }
            ?>
            <form class="box" action="" method="post" name="login">
                <h1>Connexion</h1>
                <input type="text" class="form-control" name="login" placeholder="Email">
                <input type="password" class="form-control" name="password" placeholder="Mot de passe">
                <input type="submit" value="Connexion " name="submit" class="btn btn-primary">
                <p>Vous êtes nouveau ici? <a href="index.php">S'inscrire</a></p>
                <?php if (! empty($message)) { ?>
                    <p class="errorMessage"><?php echo $message; ?></p>
                <?php } ?>
            </form>
        </div>
    </body>
</html>