<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotell</title>
    <link rel="stylesheet" href="../IS-115-Gruppeoppgave/CSS/styles.css" />
</head>
<body>
<?php
include('../IS-115-Gruppeoppgave/Include/header.php');
include('../IS-115-Gruppeoppgave/Include/footer.php');
?>


<?php

  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST;
}
    ?>
  
  <body>
  <b><p style="text-align: center; font-size: 30px;">Login</p></b>
  <pre>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  Fornavn: <input type="text" name="fnavn" placeholder="Brukernavn"><br>
  Etternavn: <input type="text" name="enavn" placeholder="Passord"><br>
  
  <input type="submit" name="login" value="Login">

</form>
  </pre>
  </body>

</html>
