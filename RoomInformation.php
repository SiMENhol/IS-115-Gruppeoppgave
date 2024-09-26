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


    $romtyper = array (
  array("Enkeltrom",22,18),
  array("Dobbeltrom",15,13),
  array("Duplex",17,15),
  array("Suite",5,3)
);

echo "Det finnes av romtype ". $romtyper[0][0]." ".$romtyper[0][1]." rom, av disse er ".$romtyper[0][2]." booket. Det er ".$romtyper[0][1] - $romtyper[0][2]." rom ledige."."<br>";
echo "Det finnes av romtype ". $romtyper[1][0]." ".$romtyper[1][1]." rom, av disse er ".$romtyper[1][2]." booket. Det er ".$romtyper[1][1] - $romtyper[1][2]." rom ledige."."<br>";
echo "Det finnes av romtype ". $romtyper[2][0]." ".$romtyper[2][1]." rom, av disse er ".$romtyper[2][2]." booket. Det er ".$romtyper[2][1] - $romtyper[2][2]." rom ledige."."<br>";
echo "Det finnes av romtype ". $romtyper[3][0]." ".$romtyper[3][1]." rom, av disse er ".$romtyper[3][2]." booket. Det er ".$romtyper[3][1] - $romtyper[3][2]." rom ledige."."<br>";


/*
for ($rad = 0; $rad < 4; $rad++) {
    echo "<ul>";
      for ($kol = 0; $kol < 3; $kol++) {
        echo "<li>" . $romtyper[$rad][$kol] . "</li>";
      }
    echo "</ul>";
  }
*/
?>
</body>
</html>
