<?php
$servername = "localhost:3307"; //Port endret til 3307 pga standard port 3306 er i bruk
$username = "root"; //Brukernavn til databasen
$password = "your_root_password"; //Passordet for brukeren til databasen
$dbname = "HotellServicedb"; //Navnet på databasen

// Lager en kobling til databasen ved hjelp av mysqli
$conn = new mysqli($servername, $username, $password, $dbname);
// Sjekker om koblingen fungere.
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
