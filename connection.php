<?php
session_start();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <?php 
            include("config.php");
            if(isset($_POST['submit'])){
                $email = mysqli_real_escape_string($connection,$_POST['email']);
                $password = mysqli_real_escape_string($connection,$_POST['password']);

                $result = mysqli_query($connection,"SELECT * FROM utilisateurs WHERE email='$email' AND password='$password' ") or die("Select Error");
                $row = mysqli_fetch_assoc($result);

                if(is_array($row) && !empty($row)){
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['username'] = $row['Username'];
                    $_SESSION['tele'] = $row['tele'];
                    $_SESSION['id'] = $row['Id'];
                    $_SESSION['balance'] = $row['balance'];
                }else{
                    echo "<div class='message'>
                      <p>Non utilisateur ou Mot de passe incorrect</p>
                       </div> <br>";
                   echo "<a href='connection.php'><button class='btn'>Retour</button>";
         
                }
                if(isset($_SESSION['email'])){
                    header("Location: home.php");
                }
              }else{

            
            ?>
            <header>
                Connexion
            </header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Email</label>
                    <input type="text" name="email" id="email" required>
                </div>

                <div class="field input">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" required>
                </div>

                <div class="field">
                    <input type="submit" name="submit" value="Connexion" class="btn">
                </div>
                <div class="link">
                    Pas de compte? <a href="registre.php">Créer un compte</a>
                </div>
            </form>
        </div>
        <?php }?>
    </div>
    
</body>
</html>
