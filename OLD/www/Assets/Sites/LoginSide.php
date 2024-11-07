<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotell</title>
    <!-- Henter to stylesheet siden denne ikke bruker samme layout som resten av prosjektet -->
    <link rel="stylesheet" href="../CSS/styles.css" />
    <link rel="stylesheet" href="../CSS/login.css" />
</head>
<body>
<?php
//Inkludere 2 files fra include mappen
include('../../Include/header.php');
include('../../Include/footer.php');
//TODO, inkludere databasen for å kunne logge inn

//TODO
//En post metode som skal ta imot en request metode og poste den
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST;
}
    ?>

    <body>
    <div class="form">
        <div class="title">Vennligst login</div>
        <!-- TODO -->
        <!-- En form som skal ta epost og passord og bruke action til å sende inn for å kunne logge inn -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

            <!--Input for Epost -->
            <div class="input-container ic1">
                <input type="text" name="epost" placeholder=" " class="input" required>
            <div class="cut"></div>
                <label asp-for="Email" class="placeholder"><b>Epost</b></label>
                <span validation-for="Email" class="text-danger"></span>
            </div>

            <!-- Input for Passord-->
            <div class="input-container ic2">
                <input for="Password" type="password" placeholder=" " class="input" required>
            <div class="cut2"></div>
                <label for="Password" class="placeholder"><b>Passord</b></label>
                <span validation-for="Password" class="text-danger"></span>

            <!-- Login knapp-->
            <button type="submit" class="submit">Login</button>
        </form>
    </body>
</html>

<!-- Skript som brukere kan trykke på ved feil -->
<script>
    function showAlert() {
        alert("Vennligst rapporter problemet til ledelsen");
    }
</script>
