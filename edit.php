<?php 

session_start();
include("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le profil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="nav">
        <div class="logo"><p>CryptoK</p></div>
        <div class="right-link">
            <a href="logout.php"><button class="btn">Déconnexion</button></a>
        </div>
    </header>

    <section class="container">
        <div class="box form-box">
            <?php 
            if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $tel = $_POST['tel'];
                $password = $_POST['password']; 

                // Update the user's profile in the database
                $edit = mysqli_query($connection, "UPDATE utilisateurs SET username='$username', email='$email', tele='$tel', password='$password' WHERE email='{$_SESSION['email']}'") or die("Error: " . mysqli_error($connection));

                if($edit){
                    echo "<div class='message'>
                    <p>Profil modifié!</p>
                </div> <br>";
                    echo "<a href='home.php'><button class='btn'>Home</button>";
                } else {
                    echo "Failed to update profile. Please try again later.";
                }
            }
            ?>
            <header>
                Modifier le profil
            </header>
            <form action="edit.php" method="post">
                <div class="field input">
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" name="username" id="username" required autocomplete="username">
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required autocomplete="email">
                </div>

                <div class="field input">
                    <label for="tele">Téléphone</label>
                    <input type="tel" name="tel" id="tel" required autocomplete="tel">
                </div>

                <div class="field input">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" required autocomplete="new-password">
                </div>

                <div class="field">
                    <input type="submit" name="submit" value="Modifier" class="btn">
                </div>
            </form>
        </div>
    </section>
</body>
</html>
