<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>enregistrer</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="box form-box">

        <?php
            include("config.php");
            if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $tele = $_POST['tele'];
                $password = $_POST['password'];

                $verify_query = mysqli_query($connection, "SELECT email FROM utilisateurs WHERE email='$email'");
                if(mysqli_num_rows($verify_query) != 0 ){
                    echo "<div class='message'>
                            <p>Cet e-mail est déjà utilisé.</p>
                        </div> <br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Retour</button>";
                }
                else{
                    mysqli_query($connection, "INSERT INTO utilisateurs (username, email, tele, password) VALUES ('$username', '$email', '$tele', '$password')") or die("Erreur lors de l'inscription");

                    echo "<div class='message'>
                            <p>Inscription réussie!</p>
                        </div> <br>";
                    echo "<a href='connection.php'><button class='btn'>Connectez-vous maintenant</button>";
                }
            }else{
        ?>

            <header>
                Inscription
            </header>
            <form action="registre.php" method="post">
                <div class="field input">
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" name="username" id="username" required autocomplete="username">
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required autocomplete="email">
                </div>

                <div class="field input">
                    <label for="tele">Telephone</label>
                    <input type="tel" name="tele" id="tele" required autocomplete="tel">
                </div>

                <div class="field input">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" required autocomplete="new-password">
                </div>

                <div class="field">
                    <input type="submit" name="submit" value="S'inscrire" class="btn">
                </div>
                <div class="link">
                    Vous avez déjà un compte? <a href="connection.php">Connexion</a>
                </div>
            </form>
        </div>
        <?php }?>
    </div>
    
</body>
</html>
