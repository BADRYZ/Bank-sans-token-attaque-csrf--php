
<?php
session_start();
include("config.php");




// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Vérifiez si les données du formulaire sont soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les données du formulaire
    $recipientEmail = $_POST['recipientEmail'];
    $amount = $_POST['amount'];

    // Récupérez l'email de l'utilisateur connecté
    $email = $_SESSION['email'];

    // Récupérez le solde actuel de l'utilisateur
    $query = mysqli_prepare($connection, "SELECT balance FROM utilisateurs WHERE email = ?");
    mysqli_stmt_bind_param($query, "s", $email);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        $currentBalance = $row['balance'];
        
        // Soustrayez le montant transféré du solde de l'utilisateur
        $newBalance = $currentBalance - $amount;
        
        // Mettez à jour le solde de l'utilisateur dans la base de données
        $updateQuery = mysqli_prepare($connection, "UPDATE utilisateurs SET balance = ? WHERE email = ?");
        mysqli_stmt_bind_param($updateQuery, "ds", $newBalance, $email);
        mysqli_stmt_execute($updateQuery);
        
        // Redirigez l'utilisateur vers la page d'accueil avec un message de succès
        header("Location: home.php?success=1");
        exit();
        
    } else {
        // Gestion des erreurs de requête
        header("Location: home.php?error=database_error");
        exit();
    }
} else {
    // Redirection si les données du formulaire ne sont pas soumises
    header("Location: home.php");
    exit();
}
?>
