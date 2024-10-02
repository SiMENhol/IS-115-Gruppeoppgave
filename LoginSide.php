<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotell</title>
    <link rel="stylesheet" href="CSS/styles.css" />
    <link rel="stylesheet" href="CSS/login.css" />
</head>
<body>
<?php
include('Include/header.php');
include('Include/footer.php');


  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST;
}
    ?>
  
  <body>

  <div class="form">

    <div class="title">Vennligst login</div>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    
    <div class="input-container ic1">
        <input type="text" name="epost" placeholder=" " class="input" required>
            <div class="cut"></div>
        <label asp-for="Email" class="placeholder"><b>Epost</b></label>
        <span validation-for="Email" class="text-danger"></span>
        </div>
    
    <div class="input-container ic2">
        <input for="Password" type="password" placeholder=" " class="input" required>
            <div class="cut2"></div>
        <label for="Password" class="placeholder"><b>Passord</b></label>
        <span validation-for="Password" class="text-danger"></span>
            <button type="submit" class="submit">Login</button>

  

</form>

  </body>

</html>

<script>
    function showAlert() {
        alert("Vennligst rapporter problemet til ledelsen");
    }
</script>