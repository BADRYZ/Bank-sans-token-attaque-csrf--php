<?php
session_start();
include("config.php");

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to the login page or display an error message
    header("Location: login.php");
    exit();
}

// Get user details from the database
$email = $_SESSION['email'];
$query = mysqli_prepare($connection, "SELECT * FROM utilisateurs WHERE email = ?");
mysqli_stmt_bind_param($query, "s", $email);
mysqli_stmt_execute($query);
$result = mysqli_stmt_get_result($query);

if (!$result) {
    // Handle query execution error
    die("Error executing the query: " . mysqli_error($connection));
}

if ($res = mysqli_fetch_assoc($result)) {
    $re_user = $res['username'];
    $re_email = $res['email'];
    $re_tele = $res['tele'];
    $re_bal = $res['balance'];
} else {
    // Handle the case where user data is not found
}

// Escape HTML output to prevent XSS attacks
$re_user = htmlspecialchars($re_user);
$re_email = htmlspecialchars($re_email);
$re_tele = htmlspecialchars($re_tele);
$re_bal = htmlspecialchars($re_bal);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* CSS for modal */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header class="nav">
        <div class="logo"><p>CryptoK</p></div>
        <div class="right-link">
            <a href="edit.php?email=<?php echo urlencode($_SESSION['email']); ?>"><button class="btn">Change Profil</button></a>
            <a href="logout.php"><button class="btn">Déconnexion</button></a>
        </div>
    </header>
    <main>
        <div class="main-box top">
            <div class="top">
                <div class="box">
                    <p>Bonjour, <span class="username"><?php echo $re_user; ?></span></p>
                </div>
                <div class="box">
                    <p>Votre solde est : <?php echo $re_bal; ?></p>
                </div>
                <div class="button-container">
                    <!-- Bouton pour ouvrir la fenêtre modale -->
                    <div class="btn-t"><button class="btn" onclick="openModal()">Transférer</button></div>
                    <div class="btn-t"><a href="#"><button class="btn">Charger</button></a></div>
                    <div class="btn-t"><a href="#"><button class="btn">Débiter</button></a></div>
                </div>
            </div>
        </div>
    </main>

    <!-- Formulaire de transfert (initiallement masqué) -->
    <div id="transferModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Transférer des fonds</h2>
               
            <form action="process_transfer.php" method="post">
                
                 
                <div class="form-group">
                    <label for="recipientEmail">Adresse email du destinataire:</label>
                    <input type="email" id="recipientEmail" name="recipientEmail" required>
                </div>
                <div class="form-group">
                    <label for="amount">Montant à transférer:</label>
                    <input type="number" id="amount" name="amount" min="0" step="0.01" required>
                </div>
                <button type="submit" class="btn">Transférer</button>
            </form>
        </div>
    </div>

    <!-- JavaScript pour afficher/masquer la fenêtre modale -->
    <script>
        // Fonction pour ouvrir la fenêtre modale
        function openModal() {
            document.getElementById('transferModal').style.display = 'block';
        }

        // Fonction pour fermer la fenêtre modale
        function closeModal() {
            document.getElementById('transferModal').style.display = 'none';
        }
    </script>
</body>
</html>
