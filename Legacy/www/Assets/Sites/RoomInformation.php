<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotell</title>
    <link rel="stylesheet" href="../CSS/styles.css" />
</head>
<body>
<?php

//Inkludere 3 files fra include mappen
include('../../Include/header.php');
include('../../Include/footer.php');
include_once('../../Include/dbconnection.php');

// SQL kode for å hente rom og vise antall av hver romtype
$sql = "SELECT TypeRom, COUNT(*) AS antall_rom
FROM Hotellrom
GROUP BY TypeRom;";

// Får resultatet av spørringen
$result = $conn->query($sql);


if ($result->num_rows > 0) {
  // Loop gjennom resultatene og skriv ut romtypene og antall
  while($row = $result->fetch_assoc()) {
      echo "Romtype: " . $row["TypeRom"] . " - Antall rom: " . $row["antall_rom"] . "<a href='RoomInformation.php'> Book</a>" . "<br>";
  }
  // Hvis while loopen ikke finner, printes det Ingen rom funnet
} else {
  echo "Ingen rom funnet.";
}

//Stenger connection med databasen
$conn->close();

?>
</body>
</html>
